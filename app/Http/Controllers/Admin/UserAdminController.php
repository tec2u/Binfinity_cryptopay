<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\WalletController;
use App\Http\Requests\Admin\SearchRequest;
use App\Models\Banco;
use App\Models\HistoricScore;
use App\Models\OrderPackage;
use App\Models\Rede;
use App\Models\TaxCrypto;
use App\Models\User;
use App\Traits\CustomLogTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserAdminController extends Controller
{
    use CustomLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(9);
        return view('admin.users.users', compact('users'));
    }
    public function searchUsers(SearchRequest $request)
    {
        try {
            $data = $request->search;
            $users = User::where('name', 'like', '%' . $data . '%')
                ->orWhere('login', 'like', '%' . $data . '%')
                ->orWhere('email', 'like', '%' . $data . '%')
                ->paginate(9);
            return view('admin.users.users', compact('users'));
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            return redirect()->back();
        }
    }
    public function UsersFilter($parameter)
    {
        try {
            $users = User::orderBy('id', 'DESC');
            //Filters
            switch ($parameter) {
                case 'activated':
                    $users->where('activated', true);
                    break;
                case 'desactivated':
                    $users->where('activated', false);
                    break;
            }
            $users = $users->paginate(9);
            return view('admin.users.users', compact('users'));
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            return redirect()->back();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexInactive()
    {
        $users = User::orderBy('id', 'DESC')->where('activated', false)->paginate(9);
        return view('admin.users.users', compact('users'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBan()
    {
        $users = User::orderBy('id', 'DESC')->where('ban', true)->paginate(9);
        return view('admin.users.users', compact('users'));
    }
    public function myinfo()
    {
        $user = User::find(auth()->user()->id);
        $ordersPackages = OrderPackage::where('user_id', $user->id)->get();
        return view('admin.users.myinfo', compact('user', 'ordersPackages'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $ordersPackages = OrderPackage::where('user_id', $user->id)->get();

        return view('admin.users.myinfo', compact('user', 'ordersPackages'));
    }

    public function editTax($id)
    {
        $user = User::find($id);

        $test = new WalletController();
        // dd($test->calculateExtraValue(50, "BNB", 115879));

        $createTaxCrypto = new TaxCrypto();
        $createTaxCrypto->createDefaultTax($id);
        $coins = $createTaxCrypto->availableCryptos;

        $tax = TaxCrypto::where('user_id', $id)->get();
        $taxByCoin = $tax->groupBy('coin');

        return view('admin.users.taxControl', compact('user', 'coins', 'taxByCoin'));
    }

    public function updateTax(Request $request, $id)
    {
        $coins = $request->all(); // Obtém todos os dados da requisição, incluindo os dados dos campos

        // Loop para atualizar as taxas para cada moeda
        foreach ($coins as $key => $value) {
            if (strpos($key, '_tx_bin') !== false) {  // Verificando se é um campo de tx_bin
                $coin = str_replace('_tx_bin', '', $key);  // Recuperando o nome da moeda
                $taxCrypto = TaxCrypto::where('user_id', $id)->where('coin', $coin)->first();

                if ($taxCrypto) {
                    if ($value < 0) {
                        $value = 0;
                    }
                    $taxCrypto->tx_bin = $value; // Atualizando o valor de tx_bin
                    $taxCrypto->save();
                }
            }

            if (strpos($key, '_tx_gas') !== false) {  // Verificando se é um campo de tx_gas
                $coin = str_replace('_tx_gas', '', $key);  // Recuperando o nome da moeda
                $taxCrypto = TaxCrypto::where('user_id', $id)->where('coin', $coin)->first();

                if ($taxCrypto) {
                    if ($value < 0) {
                        $value = 0;
                    }
                    $taxCrypto->tx_gas = $value; // Atualizando o valor de tx_gas
                    $taxCrypto->save();
                }
            }

            if (strpos($key, '_verification_margin_dol') !== false) {  // Verificando se é um campo de verification_margin_dol
                $coin = str_replace('_verification_margin_dol', '', $key);  // Recuperando o nome da moeda
                $taxCrypto = TaxCrypto::where('user_id', $id)->where('coin', $coin)->first();

                if ($taxCrypto) {
                    if ($value < 0) {
                        $value = 1;
                    }
                    $taxCrypto->verification_margin_dol = $value; // Atualizando o valor de verification_margin_dol
                    $taxCrypto->save();
                }
            }

        }
        return redirect()->route('admin.users.editTax', ['id' => $id])
            ->with('success', 'Tax information updated successfully');
    }

    public function transactions($id)
    {
        $transactions = Banco::where('description', '<>', 3)->where('user_id', $id)->paginate(9);
        return view('admin.reports.transactions', compact('transactions'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'last_name',
            'address1',
            'address2',
            'postcode',
            'state',
            'cell',
            'birthday',
            'gender',
            'email',
            'telephone',
            'cell',
            'country',
            'rule',
            'tax_percent'
        ]);
        $user = User::find($id);
        if (($request->has('password') && $request->get('password')) && ($request->has('password_confirmation') && $request->get('password_confirmation'))) {
            if ($request->get('password') == $request->get('password_confirmation')) {
                $data['password'] = Hash::make($request->get('password'));
            } else {
                flash(__('admin_alert.password_confirm'))->warning();
                return redirect()->route('admin.users.edit', ['id' => $user->id]);
            }
        }
        try {
            $user->update($data);
            $this->createLog('User updated successfully', 200, 'success', auth()->user()->id);
            flash(__('admin_alert.user_update'))->success();
            return redirect()->route('admin.users.edit', ['id' => $user->id]);
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.user_noupdate'))->error();
            return redirect()->route('admin.users.edit', ['id' => $user->id]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inactive($id)
    {
        try {
            $user = User::find($id);
            $user->activated = false;
            $user->save();
            $this->createLog('User inactive successfully', 204, 'success', auth()->user()->id);
            flash(__('admin_alert.user_inactive'))->success();
            return redirect()->route('admin.users.index');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.user_notremove'))->error();
            return redirect()->back();
        }
    }

    public function activeUser($id)
    {
        try {
            $user = User::find($id);
            $user->activated = 1;
            $user->save();
            $this->createLog('User active successfully', 204, 'success', auth()->user()->id);
            flash('user actived')->success();
            return redirect()->route('admin.users.index');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.user_notremove'))->error();
            return redirect()->back();
        }
    }
    public function networkuser($parameter)
    {
        $rede = Rede::where('user_id', $parameter)->first();
        $name = empty($rede->upline_id) ? "" : Rede::find($rede->upline_id)->user->name;
        $redename = $rede->user->login;
        $id = $rede->id;
        $qty = $rede->qty;
        $email = $rede->user->email;
        $volume = $rede->user->getVolume($rede->user->id);
        $tag = '';
        $pay = OrderPackage::where('user_id', $rede->user->id)->where('status', 1)->where('payment_status', 1)->first();
        $getadessao = $rede->user->getAdessao($rede->user->id);
        $getpackages = $rede->user->getPackages($rede->user->id);
        if (!$pay) {
            $tag = ["Inactive"];
        }
        if ($getadessao > 0) {
            $tag = ["PreRegistration"];
        }
        if ($getpackages > 0) {
            $tag = ["AllCards"];
        }
        $rede_users = Rede::where('upline_id', $id)->get()->count();
        if ($rede_users > 0) {
            $network = $this->getNetwork($rede->id);
            $networks[] = array(
                "id" => "$id",
                "name" => "$redename",
                "img" => "https://cdn.balkan.app/shared/empty-img-none.svg",
                "size" => ".$qty",
                "referred" => $name,
                "email" => $email,
                "volume" => "Volume: $volume",
                "tags" => $tag
            );
            $networks = array_merge($network, $networks);
        } else {
            $network = $this->getNetwork($rede->id);
            $networks = array(
                array(
                    "id" => "$id",
                    "name" => "$redename",
                    "img" => "https://cdn.balkan.app/shared/empty-img-none.svg",
                    "size" => ".$qty",
                    "referred" => $name,
                    "volume" => "Volume: $volume",
                    "tags" => $tag
                )
            );
        }
        //$networks += $this->getNetwork($rede->id);
        // {
        //     id: 1,
        //     name: "Amber McKenzie",
        //     img: "https://cdn.balkan.app/shared/empty-img-none.svg",
        //     size: 10,
        //     referred: "master"
        // },
        $networks = json_encode($networks);
        //$networks = str_replace(array("\n", "\r"), '', $networks);
        //dd($networks);
        return view('admin.users.rede', compact('networks'));
    }
    public function networkuserdiferente($parameter)
    {
        $rede = Rede::where('user_id', $parameter)->first();
        $name = empty($rede->upline_id) ? "" : Rede::find($rede->upline_id)->user->login;
        $redename = $rede->user->login;
        $id = $rede->id;
        $network = $this->getNetworkDiferente($rede->id);
        if ($network != NULL) {
            $networks['tree'] = array($id => $network['tree']);
            $networks['params'] = array(
                $id => array(
                    'trad' => $redename . ' </br>',
                    'styles' => array(
                        'font-weight' => '600',
                        'font-size' => '18px',
                        'background-color' => '#f3f3f37a',
                        'color' => 'red',
                        'box-shadow' => '0 0 4px 1px #aeaeae',
                        'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                    )
                )
            );
            $networks['params'] = $network['params'] + $networks['params'];
        } else {
            $networks['tree'] = array($id => '');
            $networks['params'] = array(
                $id => array(
                    'trad' => $redename . ' </br>',
                    'styles' => array(
                        'font-weight' => '600',
                        'font-size' => '18px',
                        'background-color' => '#f3f3f37a',
                        'color' => 'red',
                        'box-shadow' => '0 0 4px 1px #aeaeae',
                        'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                    )
                )
            );
        }
        $tree = json_encode($networks['tree']);
        $params = json_encode($networks['params']);
        return view('admin.users.rede_diferente', compact('tree', 'params'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ban($id)
    {
        try {
            $user = User::find($id);
            $user->ban = true;
            $user->update();
            $this->createLog('User ban successfully', 204, 'success', auth()->user()->id);
            flash(__('admin_alert.userban'))->success();
            return redirect()->route('admin.users.index');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.user_notban'))->error();
            return redirect()->back();
        }
    }
    public function password()
    {
        return view('admin.changePassword.changePassword');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $data = $request->only([
            'password',
            'old_password'
        ]);
        try {
            $id = auth()->user()->id;
            $user = User::find($id);
            if (!Hash::check($data['old_password'], $user->password)) {
                flash(__('admin_alert.changepassword_error'))->error();
                return redirect()->back();
            }
            $password = Hash::make($data['password']);
            $user->update([
                'password' => $password
            ]);
            $this->createLog('Password updated successfully', 200, 'success', auth()->user()->id);
            flash(__('admin_alert.changepassword'))->success();
            return redirect()->route('admin.users.password');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.changepassword_error2'))->error();
            return redirect()->back();
        }
    }
    private function getNetwork($id, $cont = '')
    {
        $cont = empty($cont) ? 1 : $cont;
        $rede_users = Rede::where('upline_id', $id)->get();
        $networks = array();
        foreach ($rede_users as $rede) {
            $name = empty(Rede::find($rede->upline_id)) ? "" : Rede::find($rede->upline_id)->first()->user->name;
            $redename = $rede->user->login;
            $id = $rede->id;
            $qty = $rede->qty;
            $email = $rede->user->email;
            $upline = $rede->upline_id;
            $volume = $rede->user->getVolume($rede->user->id);
            $tag = '';
            $pay = OrderPackage::where('user_id', $rede->user->id)->where('status', 1)->where('payment_status', 1)->first();
            $getadessao = $rede->user->getAdessao($rede->user->id);
            $getpackages = $rede->user->getPackages($rede->user->id);
            if (!$pay) {
                $tag = ["Inactive"];
            }
            if ($getadessao > 0) {
                $tag = ["PreRegistration"];
            }
            if ($getpackages > 0) {
                $tag = ["AllCards"];
            }
            $networks[] = array(
                "id" => "$id",
                "pid" => "$upline",
                "name" => "$redename",
                "img" => "https://cdn.balkan.app/shared/empty-img-none.svg",
                "size" => "$qty",
                "referred" => $name,
                "email" => $email,
                "volume" => "Volume: $volume ",
                "btn" => "<a href='" . route('admin.users.network', ['parameter' => $rede->user->id]) . "'> More + </a>",
                "tags" => $tag
            );
            $cont++;
            if ($cont < 3) {
                $networks = array_merge($this->getNetwork($rede->id, $cont), $networks);
            }
        }
        //dd($networks);
        return $networks;
    }
    private function getNetworkDiferente($parameter)
    {
        $redes = Rede::where('upline_id', $parameter)->get();
        if ($redes == NULL)
            return NULL;
        $networks = array();
        foreach ($redes as $rede) {
            $redename = $rede->user->login;
            $id = $rede->id;
            $network = $this->getNetworkDiferente($rede->id);
            if ($network != NULL) {
                if (isset($networks['tree'])) {
                    $networks['tree'] = $networks['tree'] + array($id => $network['tree']);
                    $networks['params'] = $networks['params'] + array(
                        $id => array(
                            'trad' => $redename . ' </br> <a style="font-size: 14px; color: #111111; text-decoration: none !important;display: flex;justify-content: flex-end"href="' . route('admin.users.network', ['parameter' => $rede->user->id]) . '"> More + </a>',
                            'styles' => array(
                                'font-weight' => '600',
                                'font-size' => '18px',
                                'background-color' => '#f3f3f37a',
                                'color' => 'red',
                                'box-shadow' => '0 0 4px 1px #aeaeae',
                                'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                            )
                        )
                    );
                } else {
                    $networks['tree'] = array($id => $network['tree']);
                    $networks['params'] = array(
                        $id => array(
                            'trad' => $redename . ' </br> <a style="font-size: 14px; color: #111111; text-decoration: none !important;display: flex;justify-content: flex-end"href="' . route('admin.users.network', ['parameter' => $rede->user->id]) . '"> More + </a>',
                            'styles' => array(
                                'font-weight' => '600',
                                'font-size' => '18px',
                                'background-color' => '#f3f3f37a',
                                'color' => 'red',
                                'box-shadow' => '0 0 4px 1px #aeaeae',
                                'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                            )
                        )
                    );
                }
                $networks['params'] = $network['params'] + $networks['params'];
            } else {
                if (isset($networks['tree'])) {
                    $networks['tree'] = $networks['tree'] + array($id => '');
                    $networks['params'] = $networks['params'] + array(
                        $id => array(
                            'trad' => $redename . ' </br> <a style="font-size: 14px; color: #111111; text-decoration: none !important;display: flex;justify-content: flex-end"href="' . route('admin.users.network', ['parameter' => $rede->user->id]) . '"> More + </a>',
                            'styles' => array(
                                'font-weight' => '600',
                                'font-size' => '18px',
                                'background-color' => '#f3f3f37a',
                                'color' => 'red',
                                'box-shadow' => '0 0 4px 1px #aeaeae',
                                'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                            )
                        )
                    );
                } else {
                    $networks['tree'] = array($id => '');
                    $networks['params'] = array(
                        $id => array(
                            'trad' => $redename . ' </br> <a style="font-size: 14px; color: #111111; text-decoration: none !important;display: flex;justify-content: flex-end"href="' . route('admin.users.network', ['parameter' => $rede->user->id]) . '"> More + </a>',
                            'styles' => array(
                                'font-weight' => '600',
                                'font-size' => '18px',
                                'background-color' => '#f3f3f37a',
                                'color' => 'red',
                                'box-shadow' => '0 0 4px 1px #aeaeae',
                                'font-family' => '"Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"'
                            )
                        )
                    );
                }
            }
        }
        return $networks;
    }
    public function dashboard($id)
    {
        $user = User::find($id);
        Auth::login($user);
        return redirect()->intended('home');
    }
    public function specialcomission($id)
    {
        $user = User::find($id);
        return view('admin.users.specialcomission', compact('user'));
    }
    public function upspecialcomission(Request $request, $id)
    {
        $data = $request->only([
            'special_comission',
            'special_comission_active'
        ]);
        $user = User::find($id);
        try {
            $user->update($data);
            $this->createLog('User updated successfully', 200, 'success', auth()->user()->id);
            flash(__('admin_alert.user_update'))->success();
            return redirect()->route('admin.users.index');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.user_noupdate'))->error();
            return redirect()->route('admin.users.index');
        }
    }
}
