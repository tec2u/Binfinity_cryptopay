<?php

namespace App\Http\Controllers;

use App\Models\IpAccessApi;
use App\Models\NodeOrders;
use App\Models\OrderPackage;
use App\Models\Package;
use App\Models\Rede;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Hash;
use stdClass;

class ApiApp extends Controller
{
    private function getUser($request)
    {
        try {
            //code...

            $token = $request->header('Authorization');

            // Verificar se o token está no formato correto
            if (strpos($token, 'Bearer ') !== 0) {
                return false;
            }

            $token = substr($token, 7);

            $tkn = PersonalAccessToken::where('token', $token)->first();

            $agora = Carbon::now();
            $expiracao = Carbon::parse($tkn->expires_at);

            if (!$tkn) {
                return false;
            }

            if ($agora->gt($expiracao)) {
                return false;
            }

            $user = User::where('id', $tkn->tokenable_id)->first();

            if (!$user) {
                return false;
            }

            $tkn->last_used_at = Carbon::now()->format('Y-m-d H:i:s');
            $tkn->save();

            if ($user->activated == 0) {
                return response()->json(['error' => 'Account awaiting approval'], 401);
            }

            return $user;

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error in process token'], 401);
        }
    }

    public function login(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validatedData->fails()) {
            return response()->json(['error' => $validatedData->errors()], 422);
        }

        $ip = $request->ip();

        $tryFailed = IpAccessApi::where('operation', 'api/app/validate/login/failed')->where('ip', $ip)->whereDate('created_at', Carbon::today())->get();

        if (count($tryFailed) > 5) {
            return response()->json(['error' => 'There were too many login attempts today'], 422);
        }

        $requestFormated = $request->all();

        $ipRequest = new IpAccessApi;
        $ipRequest->ip = $ip;
        $ipRequest->operation = "api/app/validate/login";
        $ipRequest->request = json_encode($requestFormated);
        $ipRequest->save();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();
            $accessToken = $user->createToken('Login', ['*'], Carbon::now()->addDay());

            $token = $accessToken->plainTextToken;

            $parteAntesDoPipe = strstr($token, '|', true); // Obtém a parte antes do primeiro '|'

            if ($parteAntesDoPipe !== false) {
                $ttk = PersonalAccessToken::where('id', $parteAntesDoPipe)->first();
                if (!isset ($ttk)) {
                    return response()->json(['error' => 'Error in generate token'], 401);
                }

                return response()->json(['token' => $ttk->token], 200);

            } else {
                return response()->json(['error' => 'Error in generate token'], 401);
            }

        } else {
            $ip = $request->ip();
            $requestFormated = $request->all();

            $ipRequest = new IpAccessApi;
            $ipRequest->ip = $ip;
            $ipRequest->operation = "api/app/validate/login/failed";
            $ipRequest->request = json_encode($requestFormated);
            $ipRequest->save();
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function register(Request $request)
    {
        try {

            $validatedData = Validator::make($request->all(), [
                'name' => 'required|string|string',
                'login' => 'required|string|string',
                'email' => 'required|string|email',
                'password' => 'required|string',
                'cell' => 'required',
                'country' => 'required|string',
                'city' => 'required|string',
                'last_name' => 'required|string',
                'recommendation_user_id' => 'required',
            ]);

            if ($validatedData->fails()) {
                return response()->json(['error' => $validatedData->errors()], 422);
            }

            $ip = $request->ip();
            $requestFormated = $request->all();

            $ipRequest = new IpAccessApi;
            $ipRequest->ip = $ip;
            $ipRequest->operation = "api/app/register/user";
            $ipRequest->request = json_encode($requestFormated);
            $ipRequest->save();

            $exists = User::where('email', $request->email)->orWhere('login', $request->login)->first();

            if (isset ($exists)) {
                return response()->json(['error' => "User already exists"]);
            }

            $user_rec = User::where('id', $request->recommendation_user_id)->orWhere('login', $request->recommendation_user_id)->first();

            if (!isset ($user_rec)) {
                return response()->json(['error' => "Referral invalid"]);
            }

            $recommendation = $user_rec != null ? $user_rec->id : '3';


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'login' => $request->login,
                'activated' => 0,
                'password' => Hash::make($request->password),
                'financial_password' => Hash::make($request->password),
                'recommendation_user_id' => $recommendation,
                'special_comission' => 1,
                'special_comission_active' => 0,
                'cell' => $request->cell,
                'country' => $request->country,
                'city' => $request->city,
                'last_name' => $request->last_name,
                // 'telephone' => $data['telephone'],
                // 'gender'   => $data['gender'],
                // 'address1' => $data['address1'],
                // 'address2' => $data['address2'],
                // 'postcode' => $data['postcode'],
                // 'state'    => $data['state'],
                // 'birthday' => date('Y-m-d', strtotime($data['birthday'])),
                // 'id_card' => $data['id_card']
            ]);


            $rede_recommedation = Rede::where('user_id', $recommendation)->first();

            $user->rede()->create([
                "upline_id" => $rede_recommedation->id,
                "qty" => 0,
                "ciclo" => 1,
                "saque" => 0
            ]);

            $rede_recommedation->update([
                "qty" => $rede_recommedation->qty + 1
            ]);


            return $this->login($request);

        } catch (\Throwable $th) {
            return response()->json(['error' => "Failed to create User"]);
        }

    }

    public function createInvoice(Request $request)
    {
        try {
            $user = $this->getUser($request);
            if ($user == false) {
                return response()->json(['error' => "Invalid token"]);
            }

            $validatedData = Validator::make($request->all(), [
                'coin' => ['required', 'string', Rule::in(['BTC', 'ETH', 'TRX', 'USDT_TRC20', 'USDT_ERC20'])],
                'value' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/', 'min:30']
            ]);

            if ($validatedData->fails()) {
                return response()->json(['error' => $validatedData->errors()], 422);
            }

            $ip = $request->ip();
            $requestFormated = $request->all();

            $ipRequest = new IpAccessApi;
            $ipRequest->ip = $ip;
            $ipRequest->operation = "api/app/register/invoice";
            $ipRequest->request = json_encode($requestFormated);
            $ipRequest->save();

            if ($request->value < 30) {
                # code... 
                return response()->json(['error' => "The value field must be at least 30."], 422);
            }

            $package = Package::where('id', 20)->first();

            if ($request->coin == 'USDT_TRC20' || $request->coin == 'USDT_ERC20') {
                $trc20 = 1;
                $erc20 = 1;

                $price_order = $request->value;

                $moedas = [
                    "USDT_ERC20" => number_format($price_order / $erc20, 2),
                    "USDT_TRC20" => number_format($price_order / $trc20, 2),
                ];
            } else {
                $api_key = 'ca699a34-d3c2-4efc-81e9-6544578433f8';

                $response = Http::withHeaders([
                    'X-CMC_PRO_API_KEY' => $api_key,
                    'Content-Type' => 'application/json',
                ])->get('https://pro-api.coinmarketcap.com/v2/cryptocurrency/quotes/latest?symbol=btc,eth,trx,erc20,USDT');

                $data = $response->json();

                $price_order = $request->value;

                $btc = $data['data']['BTC'][0]['quote']['USD']['price'];
                $trc20 = 1;
                $erc20 = 1;
                $trx = $data['data']['TRX'][0]['quote']['USD']['price'];
                $eth = $data['data']['ETH'][0]['quote']['USD']['price'];

                $moedas = [
                    "BITCOIN" => number_format($price_order / $btc, 5),
                    "ETH" => number_format($price_order / $eth, 4),
                    "USDT_ERC20" => number_format($price_order / $erc20, 2),
                    "TRX" => number_format($price_order / $trx, 2),
                    "USDT_TRC20" => number_format($price_order / $trc20, 2),
                ];
            }

            $Walletcontroller = new WalletController;

            $wallet = $Walletcontroller->returnWallet($request->coin, $user->id);
            if (!$wallet) {
                return response()->json(['error' => "Invalid wallet"]);
            }

            $walletExists = $Walletcontroller->walletTxtWexists($user->id, $Walletcontroller->secured_decrypt($wallet->address));

            if (isset ($walletExists) && json_decode($walletExists)) {
                $jsonW = json_decode($walletExists);
                if (isset ($jsonW->address)) {
                    $newOrder = new OrderPackage;
                    $newOrder->user_id = $user->id;
                    $newOrder->reference = $package->name;
                    $newOrder->payment_status = 0;
                    $newOrder->transaction_code = 0;
                    $newOrder->package_id = $package->id;
                    $newOrder->price = $request->value;
                    $newOrder->amount = 1;
                    $newOrder->transaction_wallet = 0;
                    $newOrder->printscreen = '-';
                    $newOrder->pass = '-';
                    $newOrder->server = '-';
                    $newOrder->user = '-';
                    $newOrder->price_crypto = $moedas[$request->coin];
                    $newOrder->wallet = $wallet->id;
                    $newOrder->save();


                    $controller = new PackageController;

                    $orderr = new stdClass();
                    $orderr->id = $newOrder->id;
                    $orderr->id_user = $newOrder->user_id;
                    $orderr->price = $newOrder->price;

                    // $orderr->price_crypto = $newOrder->price_crypto;

                    if (strpos($moedas[$request->coin], ',') !== false) {
                        $orderr->price_crypto = str_replace(",", "", $moedas[$request->coin]);
                    } else {
                        $orderr->price_crypto = $moedas[$request->coin];
                    }

                    $orderr->wallet = $wallet->address;
                    $orderr->notify_url = route('notify.payment');
                    $orderr->id_encript = $wallet->id;

                    $postNode = $controller->genUrlCrypto($request->coin, $orderr);

                    $ord = OrderPackage::where('id', $newOrder->id)->first();
                    $ord->transaction_wallet = $postNode->merchant_id;
                    $ord->id_node_order = $postNode->id;
                    $ord->save();

                    $nodeOrderSave = NodeOrders::where('id', $postNode->id)->first();

                    $logo = null;

                    if ($nodeOrderSave->coin == 'BITCOIN') {
                        $logo = 'https://cryptologos.cc/logos/bitcoin-btc-logo.png?v=029';
                    }
                    if ($nodeOrderSave->coin == 'TRX') {
                        $logo = 'https://cryptologos.cc/logos/tron-trx-logo.png?v=029';
                    }
                    if ($nodeOrderSave->coin == 'ETH') {
                        $logo = 'https://cryptologos.cc/logos/ethereum-eth-logo.png?v=029';
                    }
                    if ($nodeOrderSave->coin == 'USDT_TRC20') {
                        $logo = 'https://yecier-paylinks.netlify.app/images/payments/tron-usdt.png';
                    }
                    if ($nodeOrderSave->coin == 'USDT_ERC20') {
                        $logo = 'https://cryptologos.cc/logos/tether-usdt-logo.png?v=029';
                    }

                    $walletDecrypted = $Walletcontroller->secured_decrypt($wallet->address);

                    return response()->json([
                        'id' => $nodeOrderSave->id,
                        'coin' => $nodeOrderSave->coin,
                        'logo' => $logo,
                        'qrcode' => "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=$walletDecrypted",
                        'address' => $walletDecrypted,
                        'value_crypto' => $nodeOrderSave->price_crypto * 1,
                        'value_dollars' => $nodeOrderSave->price * 1,
                        'created_at' => $nodeOrderSave->createdAt
                    ]);

                }
            } else {
                try {
                    $userAprov = $user;
                    $url = env('SERV_TXT');
                    $json = [
                        "action" => "saveLog",
                        "content" => "(INVOICE) Email: $userAprov->email - Coin: " . $request->coin . " - Wallet: $wallet->address - PriceCrypto: " . $moedas[$request->coin] . " - priceDol: " . $request->value,
                        "operation" => "Wallet not found",
                        "user_id" => $userAprov->id
                    ];

                    $response = Http::post("$url/", $json);

                    if ($response->successful()) {
                        $content = $response->body();
                        if (isset ($content)) {
                        }

                    } else {
                        $status = $response->status();
                        $content = $response->body();
                    }
                    //code...
                } catch (\Throwable $th) {
                    //throw $th;
                }

                $walletdel = Wallet::where('id', $wallet->id)->first();
                $walletdel->delete();

                return response()->json(['error' => "Wallet invalid, try again"]);
            }

        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed to create invoice']);
        }

    }


    public function returnUser(Request $request)
    {
        $user = $this->getUser($request);

        $ip = $request->ip();
        $requestFormated = $request->all();

        $ipRequest = new IpAccessApi;
        $ipRequest->ip = $ip;
        $ipRequest->operation = "api/app/get/user";
        $ipRequest->request = json_encode($requestFormated);
        $ipRequest->save();

        if ($user == false) {
            return response()->json(['error' => "Invalid token"]);
        }

        return response()->json($user);

    }

    public function getInvoice(Request $request)
    {

        try {
            //code...


            $user = $this->getUser($request);
            if ($user == false) {
                return response()->json(['error' => "Invalid token"]);
            }

            $validatedData = Validator::make($request->all(), [
                'id' => 'required|numeric',
            ]);

            if ($validatedData->fails()) {
                return response()->json(['error' => $validatedData->errors()], 422);
            }

            $ip = $request->ip();
            $requestFormated = $request->all();

            $ipRequest = new IpAccessApi;
            $ipRequest->ip = $ip;
            $ipRequest->operation = "api/app/get/invoice";
            $ipRequest->request = json_encode($requestFormated);
            $ipRequest->save();

            $nodeOrderSave = NodeOrders::where('id', $request->id)->first();

            if (!isset ($nodeOrderSave)) {
                return response()->json(['error' => "Invoice not found"]);
            }

            $logo = null;

            if ($nodeOrderSave->coin == 'BITCOIN') {
                $logo = 'https://cryptologos.cc/logos/bitcoin-btc-logo.png?v=029';
            }
            if ($nodeOrderSave->coin == 'TRX') {
                $logo = 'https://cryptologos.cc/logos/tron-trx-logo.png?v=029';
            }
            if ($nodeOrderSave->coin == 'ETH') {
                $logo = 'https://cryptologos.cc/logos/ethereum-eth-logo.png?v=029';
            }
            if ($nodeOrderSave->coin == 'USDT_TRC20') {
                $logo = asset('images/tron-usdt.png');
            }
            if ($nodeOrderSave->coin == 'USDT_ERC20') {
                $logo = 'https://cryptologos.cc/logos/tether-usdt-logo.png?v=029';
            }

            $Walletcontroller = new WalletController;
            $walletDecrypted = $Walletcontroller->secured_decrypt($nodeOrderSave->wallet);

            return response()->json([
                'id' => $nodeOrderSave->id,
                'coin' => $nodeOrderSave->coin,
                'status' => $nodeOrderSave->status,
                'logo' => $logo,
                'qrcode' => "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=$walletDecrypted",
                'address' => $walletDecrypted,
                'value_crypto' => $nodeOrderSave->price_crypto * 1,
                'value_dollars' => $nodeOrderSave->price * 1,
                'created_at' => $nodeOrderSave->createdAt
            ]);

        } catch (\Throwable $th) {
            return response()->json(['error' => "Error in return invoice"]);
        }

    }
    public function getInvoices(Request $request)
    {

        try {

            $user = $this->getUser($request);
            if ($user == false) {
                return response()->json(['error' => "Invalid token"]);
            }

            $ip = $request->ip();
            $requestFormated = $request->all();

            $ipRequest = new IpAccessApi;
            $ipRequest->ip = $ip;
            $ipRequest->operation = "api/app/get/invoices";
            $ipRequest->request = json_encode($requestFormated);
            $ipRequest->save();

            $nodeOrdersSave = NodeOrders::where('id_user', $user->id)->orderBy('id', 'desc')->get();

            if (count($nodeOrdersSave) < 1) {
                return response()->json(['error' => "Invoice not found"]);
            }

            $arrReturn = [];
            $Walletcontroller = new WalletController;

            foreach ($nodeOrdersSave as $nodeOrderSave) {

                $logo = null;

                if ($nodeOrderSave->coin == 'BITCOIN') {
                    $logo = 'https://cryptologos.cc/logos/bitcoin-btc-logo.png?v=029';
                }
                if ($nodeOrderSave->coin == 'TRX') {
                    $logo = 'https://cryptologos.cc/logos/tron-trx-logo.png?v=029';
                }
                if ($nodeOrderSave->coin == 'ETH') {
                    $logo = 'https://cryptologos.cc/logos/ethereum-eth-logo.png?v=029';
                }
                if ($nodeOrderSave->coin == 'USDT_TRC20') {
                    $logo = 'https://yecier-paylinks.netlify.app/images/payments/tron-usdt.png';
                }
                if ($nodeOrderSave->coin == 'USDT_ERC20') {
                    $logo = 'https://cryptologos.cc/logos/tether-usdt-logo.png?v=029';
                }

                $walletDecrypted = $Walletcontroller->secured_decrypt($nodeOrderSave->wallet);

                array_push($arrReturn, [
                    'id' => $nodeOrderSave->id,
                    'coin' => $nodeOrderSave->coin,
                    'status' => $nodeOrderSave->status,
                    'logo' => $logo,
                    'qrcode' => "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=$walletDecrypted",
                    'address' => $walletDecrypted,
                    'value_crypto' => $nodeOrderSave->price_crypto * 1,
                    'value_dollars' => $nodeOrderSave->price * 1,
                    'created_at' => $nodeOrderSave->createdAt
                ]);
            }

            return response()->json([
                "count" => count($nodeOrdersSave),
                "invoices" => $arrReturn
            ]);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function updateUser(Request $request)
    {

    }
}
