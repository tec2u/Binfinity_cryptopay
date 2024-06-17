<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NodeOrders;
use App\Models\PriceCoin;
use App\Models\Wallet;
use App\Traits\ApiUser;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Crypt;

class ReportsController extends Controller
{
    use ApiUser;
    public function reportsHome(Request $request)
    {
        try {
            $user = $this->getUser($request);
            if ($user == false) {
                return response()->json(['error' => "Invalid token"]);
            }

            $totalRecords = NodeOrders::where('id_user', $user->id)
                ->where('type', 1)
                ->count();

            $recordsByStatus = NodeOrders::where('id_user', $user->id)
                ->where('type', 1)
                ->select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get();

            $percentageByStatus = $recordsByStatus->map(function ($item) use ($totalRecords) {
                $item->percentage = ($item->count / $totalRecords) * 100;
                return $item;
            });


            $transactions = NodeOrders::where('id_user', $user->id)
                ->where('type', 1)
                ->where(function ($query) {
                    $query->whereRaw('LOWER(status) = ?', ['paid'])
                        ->orWhereRaw('LOWER(status) = ?', ['underpaid'])
                        ->orWhereRaw('LOWER(status) = ?', ['overpaid']);
                })
                ->selectRaw('YEAR(createdAt) as date, MONTH(createdAt) as month, SUM(price) as total')
                ->groupBy(DB::raw('YEAR(createdAt)'), DB::raw('MONTH(createdAt)'))
                ->get();

            foreach ($transactions as $trans) {
                $date = Carbon::create(null, $trans->month, 1);
                $trans->month = $date->format('M');
            }

            $card = [];

            $balance = 0;
            $income = 0;
            $spending = 0;

            $wallets = Wallet::where('user_id', $user->id)->orderBy('id', 'DESC')->get()->groupBy('coin');

            $btc = PriceCoin::where('name', "BTC")->first()->one_in_usd;
            $trc20 = PriceCoin::where('name', "TRC20")->first()->one_in_usd;
            $erc20 = PriceCoin::where('name', "ERC20")->first()->one_in_usd;
            $trx = PriceCoin::where('name', "TRX")->first()->one_in_usd;
            $eth = PriceCoin::where('name', "ETH")->first()->one_in_usd;
            $sol = PriceCoin::where('name', "SOL")->first()->one_in_usd;
            $bnb = PriceCoin::where('name', "BNB")->first()->one_in_usd;


            foreach ($wallets as $chave => $valor) {

                $dep = NodeOrders::where('id_user', $user->id)
                    ->where('coin', $chave)
                    ->where(function ($query) {
                        $query->whereRaw('LOWER(status) = ?', ['paid'])
                            ->orWhereRaw('LOWER(status) = ?', ['underpaid'])
                            ->orWhereRaw('LOWER(status) = ?', ['overpaid']);
                    })
                    ->where('type', 1)
                    ->get()
                    ->sum('price_crypto_payed');

                $saq = NodeOrders::where('id_user', $user->id)
                    ->where('coin', $chave)
                    ->where(function ($query) {
                        $query->whereRaw('LOWER(status) = ?', ['paid'])
                            ->orWhereRaw('LOWER(status) = ?', ['underpaid'])
                            ->orWhereRaw('LOWER(status) = ?', ['overpaid']);
                    })
                    ->where('type', 2)
                    ->get()
                    ->sum('price_crypto_payed');

                $tt = $dep - $saq;

                $moedas = [
                    "BITCOIN" => number_format($btc * $tt, 2, '.', ''),
                    "ETH" => number_format($eth * $tt, 2, '.', ''),
                    "USDT_ERC20" => number_format($erc20 * $tt, 2, '.', ''),
                    "TRX" => number_format($trx * $tt, 2, '.', ''),
                    "USDT_TRC20" => number_format($trc20 * $tt, 2, '.', ''),
                    "SOL" => number_format($sol * $tt, 3, '.', ''),
                    "BNB" => number_format($bnb * $tt, 4, '.', ''),
                ];

                $incomes = [
                    "BITCOIN" => number_format($btc * $dep, 2, '.', ''),
                    "ETH" => number_format($eth * $dep, 2, '.', ''),
                    "USDT_ERC20" => number_format($erc20 * $dep, 2, '.', ''),
                    "TRX" => number_format($trx * $dep, 2, '.', ''),
                    "USDT_TRC20" => number_format($trc20 * $dep, 2, '.', ''),
                    "SOL" => number_format($sol * $dep, 2, '.', ''),
                    "BNB" => number_format($bnb * $dep, 2, '.', ''),
                ];

                $spendings = [
                    "BITCOIN" => number_format($btc * $saq, 2, '.', ''),
                    "ETH" => number_format($eth * $saq, 2, '.', ''),
                    "USDT_ERC20" => number_format($erc20 * $saq, 2, '.', ''),
                    "TRX" => number_format($trx * $saq, 2, '.', ''),
                    "USDT_TRC20" => number_format($trc20 * $saq, 2, '.', ''),
                    "SOL" => number_format($sol * $dep, 2, '.', ''),
                    "BNB" => number_format($bnb * $saq, 2, '.', ''),
                ];

                $balance += $moedas[$chave];
                $spending += $spendings[$chave];
                $income += $incomes[$chave];

            }

            $merchant = Crypt::encryptString($user->login);

            $card["merchant"] = $merchant;
            $card["username"] = $user->name;
            $card["activated"] = $user->activated;
            $card["total_balance"] = number_format($balance, 2);
            $card["income"] = number_format($income, 2);
            $card["spending"] = number_format($spending, 2);

            return response()->json([
                'per_status' => $percentageByStatus,
                'per_month' => $transactions,
                'cards' => [$card]
            ]);

        } catch (\Throwable $th) {
            // return response()->json(['error' => $th->getMessage()]);
            return response()->json(['error' => "Failed in get data"]);
        }

    }
}
