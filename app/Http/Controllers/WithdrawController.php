<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use App\Models\User;
use App\Models\WithdrawRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Models\Wallet;

class WithdrawController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function withdrawRequests()
   {
      $id_user  = Auth::id();

      $user = User::find($id_user);

      $withdraws = WithdrawRequest::orderBy('id', 'DESC')
      ->where('user_id', $id_user)->where('type','like','%Withdraw CC%')->paginate(9);

      return view('withdraw.withdrawrequest', compact('withdraws', 'user'));
   }

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function withdrawLog()
   {
      $id_user  = Auth::id();

      $withdraws = WithdrawRequest::orderBy('id', 'DESC')->where('user_id', $id_user)->where('status', true)->paginate(9);

      return view('withdraw.withdrawhistory', compact('withdraws'));
   }

      /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function withdrawBonus()
   {
      $id_user  = Auth::id();

      $user = User::find($id_user);

      $withdraws = WithdrawRequest::orderBy('id', 'DESC')->where('user_id', $id_user)->where('type','like','%Withdraw Comission%')->paginate(9);

      return view('withdraw.withdrawbonus', compact('withdraws','user'));
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $id_user  = Auth::id();

      $value = $request->get('value');

      $tx= $value * 0.05;

      $valuetx = $value+$tx;

      $user = User::find($id_user);
      
      $wallet = Wallet::where('user_id',$user->id)->first();

      if(empty($wallet)){
         Alert::warning(__('backoffice_alert.please_register_wallet'));
         return redirect()->route('withdraws.withdrawRequests');
      }
      if ($valuetx > $user->getTotalBanco()) {
         Alert::warning(__('backoffice_alert.dont_have_enough_balance'));
         return redirect()->route('withdraws.withdrawRequests');
      }


      try {

         $data = [
            "price"       => -$valuetx,
            "description" => "99",
            "status"      => 0

         ];

         $banco = $user->banco()->create($data);

         $datawithdraw = [
            "value"       => $value,
            "status"      => 0,
            "type"        => 'Withdraw CC'
         ];

         $withdraw = $user->withdraw()->create($datawithdraw);

         Alert::success(__('backoffice_alert.withdraw_request_created'));
         return redirect()->route('withdraws.withdrawRequests');
      } catch (Exception $e) {
         Alert::error(__('backoffice_alert.withdraw_request_not_created'));
         return redirect()->route('withdraws.withdrawRequests');
      }
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function bonus(Request $request)
   {
      $id_user  = Auth::id();

      $value = $request->get('value');

      $tx= $value * 0.05;

      $valuetx = $value+$tx;

      $user = User::find($id_user);
      
      $wallet = Wallet::where('user_id',$user->id)->first();


      if(empty($wallet)){
         Alert::warning(__('backoffice_alert.please_register_wallet'));
         return redirect()->route('withdraws.withdrawBonus');
      }
      if ($valuetx > $user->getTotalBancoIndicacao() + $user->getTotalBancoILevel()) {
         Alert::warning(__('backoffice_alert.dont_have_enough_balance'));
         return redirect()->route('withdraws.withdrawBonus');
      }


      try {

         $data = [
            "price"       => -$valuetx,
            "description" => "98",
            "status"      => 0

         ];

         $banco = $user->banco()->create($data);

         $datawithdraw = [
            "value"       => $value,
            "status"      => 0,
            "type"        => 'Withdraw Comission'
         ];

         $withdraw = $user->withdraw()->create($datawithdraw);

         Alert::success(__('backoffice_alert.withdraw_bonus_request_created'));
         return redirect()->route('withdraws.withdrawBonus');
      } catch (Exception $e) {
         Alert::error(__('backoffice_alert.withdraw_bonus_request_not_created'));
         return redirect()->route('withdraws.withdrawBonus');
      }
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
      //
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
}
