<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\WalletController;
use App\Http\Requests\Admin\SearchRequest;
use App\Models\HistoricScore as Score;
use App\Http\Controllers\Controller;
use App\Models\NodeOrders;
use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\Banco;
use App\Models\User;
use App\Models\CareerUser;
use App\Models\HistoricScore;
use App\Traits\CustomLogTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;




class ReportsAdminController extends Controller
{
   use CustomLogTrait;
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function signupcommission()
   {
      $scores = Banco::where('description', 8)->paginate(9);

      //dd($scores);

      return view('admin.reports.signupCommission', compact('scores'));
   }

   public function searchSignup(SearchRequest $request)
   {

      try {
         $data = $request->search;

         $scores = DB::table('banco')
            ->join('users', 'banco.user_id', '=', 'users.id')
            ->join('config_bonus', 'banco.description', '=', 'config_bonus.id')
            ->where('banco.description', '=', 1)
            ->where('users.name', 'like', '%' . $data . '%')
            ->paginate(9);

         flash(__('admin_alert.userfound'))->success();
         return view('admin.reports.signupCommission', compact('scores'));
      } catch (Exception $e) {
         $this->errorCatch($e->getMessage(), auth()->user()->id);
         flash(__('admin_alert.usernotfound'))->error();
         return redirect()->back();
      }
   }

   public function getDateSignup(Request $request)
   {

      $fdate = $request->get('fdate') . " 00:00:00";
      $sdate = $request->get('sdate') . " 23:59:59";

      $scores = Banco::where('description', 1)->where('created_at', '>=', $fdate)->where('created_at', '<=', $sdate)->paginate(9);

      return view('admin.reports.signupCommission', compact('scores'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function levelIncome()
   {

      $scores = Banco::where('description', 2)->paginate(9);

      return view('admin.reports.levelIncome', compact('scores'));
   }

   public function searchLevelIncome(SearchRequest $request)
   {
      try {
         $data = $request->search;

         $scores = DB::table('banco')
            ->join('users', 'banco.user_id', '=', 'users.id')
            ->join('config_bonus', 'banco.description', '=', 'config_bonus.id')
            ->where('banco.description', '=', 2)
            ->where('users.name', 'like', '%' . $data . '%')
            ->paginate(9);

         return view('admin.reports.levelIncome', compact('scores'));
      } catch (Exception $e) {
         $this->errorCatch($e->getMessage(), auth()->user()->id);

         return redirect()->back();
      }
   }

   public function getDateLevelIncome(Request $request)
   {

      try {
         $fdate = $request->fdate . " 00:00:00";
         $sdate = $request->sdate . " 23:59:59";

         $scores = Banco::where('description', 2)->where('created_at', '>=', $fdate)->where('created_at', '<=', $sdate)->paginate(9);
         flash(__('admin_alert.pkgfound'))->success();
         return view('admin.reports.levelIncome', compact('scores'));
      } catch (Exception $e) {
         $this->errorCatch($e->getMessage(), auth()->user()->id);
         flash(__('admin_alert.pkgnotfound'))->error();
         return redirect()->back();
      }
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

   public function stakingRewards()
   {


      $scores = HistoricScore::orderBy('id', 'desc')->where('description', 7)->paginate(9);

      return view('admin.reports.stakingRewards', compact('scores'));
   }

   public function searchstakingRewards(SearchRequest $request)
   {

      try {
         $data = $request->search;
         $scores = DB::table('historic_score')
            ->join('users', 'historic_score.user_id', '=', 'users.id')
            ->where('users.name', 'like', '%' . $data . '%')
            ->where('historic_score.description', '=', 7)
            ->paginate(9);

         flash(__('admin_alert.userfound'))->success();
         return view('admin.reports.stakingRewards', compact('scores'));
      } catch (Exception $e) {
         $this->errorCatch($e->getMessage(), auth()->user()->id);
         flash(__('admin_alert.usernotfound'))->error();
         return redirect()->back();
      }
   }

   public function getstakingRewards(Request $request)
   {

      $fdate = $request->get('fdate') . " 00:00:00";
      $sdate = $request->get('sdate') . " 23:59:59";

      $scores = HistoricScore::where('created_at', '>=', $fdate)->where('created_at', '<=', $sdate)->where('description', 7)->paginate(9);

      return view('admin.reports.stakingRewards', compact('scores'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function rankReward()
   {

      $career_users = CareerUser::orderBy('id', 'desc')->paginate(9);

      return view('admin.reports.rankreward', compact('career_users'));
   }

   public function searchrankReward(SearchRequest $request)
   {

      try {
         $data = $request->search;
         $career_users = DB::table('career_users')
            ->join('users', 'career_users.user_id', '=', 'users.id')
            ->join('career', 'career_users.career_id', '=', 'career.id')
            ->where('career.name', 'like', '%' . $data . '%')
            ->orWhere('users.name', 'like', "%$data%")
            ->paginate(9);


         flash(__('admin_alert.userfound'))->success();
         return view('admin.reports.rankReward', compact('career_users'));
      } catch (Exception $e) {
         flash(__('admin_alert.usernotfound'))->error();
         return redirect()->back();
      }
   }

   public function getDaterankReward(Request $request)
   {

      $fdate = $request->get('fdate') . " 00:00:00";
      $sdate = $request->get('sdate') . " 23:59:59";

      $career_users = CareerUser::where('created_at', '>=', $fdate)->where('created_at', '<=', $sdate)->paginate(9);

      return view('admin.reports.rankReward', compact('career_users'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function monthlyCoins()
   {
      $monthly_coins = Banco::where('description', 3, )->paginate(9);


      return view('admin.reports.monthlyCoins', compact('monthly_coins'));
   }

   public function searchMonthly(SearchRequest $request)
   {

      try {
         $data = $request->search;
         $monthly_coins = DB::table('banco')
            ->join('users', 'banco.user_id', '=', 'users.id')
            ->join('config_bonus', 'banco.description', '=', 'config_bonus.id')
            ->where('banco.description', '=', 3)
            ->where('users.name', 'like', "%$data%")
            ->paginate(9);


         flash(__('admin_alert.userfound'))->success();
         return view('admin.reports.monthlyCoins', compact('monthly_coins'));
      } catch (Exception) {
         flash(__('admin_alert.pkgnotfound'))->error();
         return redirect()->back();
      }
   }


   public function getDateMonthly(Request $request)
   {

      $fdate = $request->get('fdate') . " 00:00:00";
      $sdate = $request->get('sdate') . " 23:59:59";

      $monthly_coins = Banco::where('description', 3)->where('created_at', '>=', $fdate)->where('created_at', '<=', $sdate)->paginate(9);

      return view('admin.reports.monthlyCoins', compact('monthly_coins'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function transactions()
   {
      $transactions = Banco::where('description', '<>', 3)->paginate(9);
      return view('admin.reports.transactions', compact('transactions'));
   }

   public function searchTransactions(SearchRequest $request)
   {

      try {
         $data = $request->search;
         $transactions = DB::table('banco')
            ->join('users', 'banco.user_id', '=', 'users.id')
            ->join('config_bonus', 'banco.description', '=', 'config_bonus.id')
            ->where('banco.description', '<>', 3)
            ->where('users.name', 'like', '%' . $data . '%')->paginate(9);

         return view('admin.reports.transactions', compact('transactions'));
      } catch (Exception) {
         $transactions = Banco::where('description', '<>', 3)->paginate(9);
         return view('admin.reports.transactions', compact('transactions'));
      }
   }


   public function getDateTransactions(Request $request)
   {

      $fdate = $request->get('fdate') . " 00:00:00";
      $sdate = $request->get('sdate') . " 23:59:59";

      $transactions = Banco::where('description', '<>', 3)->where('created_at', '>=', $fdate)->where('created_at', '<=', $sdate)->paginate(9);

      return view('admin.reports.transactions', compact('transactions'));
   }

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function poolcommission()
   {
      $scores = Banco::where('description', 5)->paginate(9);

      //dd($scores);

      return view('admin.reports.poolCommission', compact('scores'));
   }

   public function searchPool(SearchRequest $request)
   {

      try {
         $data = $request->search;
         $scores = DB::table('banco')
            ->join('users', 'banco.user_id', '=', 'users.id')
            ->join('config_bonus', 'banco.description', '=', 'config_bonus.id')
            ->where('banco.description', 5)
            ->where('users.name', 'like', '%' . $data . '%')->paginate(9);
         flash(__('admin_alert.userfound'))->success();
         return view('admin.reports.signupCommission', compact('scores'));
      } catch (Exception $e) {
         $this->errorCatch($e->getMessage(), auth()->user()->id);
         flash(__('admin_alert.usernotfound'))->error();
         return redirect()->back();
      }
   }

   public function getDatePool(Request $request)
   {

      $fdate = $request->get('fdate') . " 00:00:00";
      $sdate = $request->get('sdate') . " 23:59:59";

      $scores = Banco::where('description', 5)->where('created_at', '>=', $fdate)->where('created_at', '<=', $sdate)->paginate(9);

      return view('admin.reports.signupCommission', compact('scores'));
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
      //te
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
      //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id)
   {
      //
   }

   public function transactionsNode()
   {
      $transactions = NodeOrders::orderBy('id', 'desc')->paginate(25);
      $walletController = new WalletController;
      foreach ($transactions as $trans) {
         $user = User::where('id', $trans->id_user)->first();
         $trans->user = $user->login ?? '';

         $wallet = $walletController->secured_decrypt($trans->wallet);
         if (isset ($wallet) && $wallet) {
            $trans->wallet = $wallet;
         }

         if ($trans->type == 1) {
            $myWithdrawn = NodeOrders::where('payment_of_id', $trans->id)->first();

            if (isset ($myWithdrawn)) {
               $trans->hashWithdrawn = $myWithdrawn->hash;
            }
         }


      }
      return view('admin.reports.transactionsNode', compact('transactions'));
   }

   public function transactionsNodeChangeWithdrawn(Request $request)
   {
      try {
         $transaction = NodeOrders::where('id', $request->id)->first();
         if (isset ($transaction)) {
            if ($transaction->withdrawn == 1) {
               $transaction->withdrawn = 0;
            } else {
               $transaction->withdrawn = 1;
            }
            $transaction->updatedAt = Carbon::now()->format('Y-m-d H:i:s');

            $transaction->save();
         }

         return redirect()->route('admin.reports.transactionsNode');
      } catch (\Throwable $th) {

         return redirect()->route('admin.reports.transactionsNode');

      }
   }

   public function notWithdrawn()
   {
      // $transactions = NodeOrders::where('type', 1)
      //    ->where(DB::raw('LOWER(status)'), 'paid')
      //    ->whereNotExists(function ($query) {
      //       $query->select(DB::raw(1))
      //          ->from('node_orders as no2')
      //          ->whereRaw('no2.payment_of_id != node_orders.id');
      //    })
      //    ->orderBy('id', 'desc')
      //    ->paginate(25);

      $transactions = NodeOrders::where('type', 1)
         ->where(DB::raw('LOWER(status)'), 'paid')
         ->where('withdrawn', 0)
         ->orderBy('id', 'desc')
         ->paginate(25);

      $walletController = new WalletController;
      foreach ($transactions as $trans) {
         $user = User::where('id', $trans->id_user)->first();
         $trans->user = $user->login ?? '';

         $wallet = $walletController->secured_decrypt($trans->wallet);
         if (isset ($wallet) && $wallet) {
            $trans->wallet = $wallet;
         }

         if ($trans->type == 1) {
            $myWithdrawn = NodeOrders::where('payment_of_id', $trans->id)->first();

            if (isset ($myWithdrawn)) {
               $trans->hashWithdrawn = $myWithdrawn->hash;
            }
         }


      }
      return view('admin.reports.transactionsNode', compact('transactions'));
   }

   public function walletsBalance()
   {
      $wallets = Wallet::paginate(25);
      $walletController = new WalletController;

      foreach ($wallets as $w) {
         $user = User::where('id', $w->user_id)->first();
         $w->user = $user->login ?? '';

         $wallet = $walletController->secured_decrypt($w->address);
         if (isset ($wallet) && $wallet) {
            $w->address = $wallet;
         }

         # code...

         $node = env('SERV_NODE');
         if ($w->coin == 'USDT_TRC20') {
            $response = Http::get("$node/api/query/wallet/tron/saldo/$wallet");

            if ($response->successful()) {
               $data = $response->json();
               $w->balance = number_format($data, 2);
            } else {
               $w->balance = 0;
            }
         } else {
            $w->balance = 0;
         }
      }

      return view('admin.reports.walletsNode', compact('wallets'));
   }
}
