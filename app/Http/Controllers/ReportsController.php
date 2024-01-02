<?php

namespace App\Http\Controllers;

use App\Models\Banco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\CareerUser;
use App\Models\User;
use App\Models\OrderPackage;
use App\Models\HistoricScore;
use App\Models\SaveDateBonusDaily;

class ReportsController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function signupcommission()
   {
      $id_user = Auth::id();
      $scores = User::find($id_user)->banco()->where('description', 1)->paginate(9);
      return view('report.signupcommission', compact('scores'));
   }


   public function bonusdaily()
   {
      $bancos = Banco::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(30);
      return view('report.signupbon', compact('bancos'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function rankReward()
   {

      $id_user = Auth::id();
      $career_users = CareerUser::where('user_id', $id_user)->orderBy('id', 'desc')->paginate(9);
      return view('report.rankreward', compact('career_users'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function levelIncome()
   {
      $id_user = Auth::id();
      $scores = User::find($id_user)->banco()->where('description', 2)->paginate(9);


      return view('report.levelincome', compact('scores'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

   public function stakingRewards()
   {
      $id_user = Auth::id();
      $scores = HistoricScore::where('user_id', $id_user)->where('description', 7)->orderBy('id', 'desc')->paginate(9);


      return view('report.stackingreward', compact('scores'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function monthlyCoins()
   {
      $id_user = Auth::id();
      $monthly_coins = User::find($id_user)->banco()->where('description', 3)->paginate(9);

      return view('report.monthlycoins', compact('monthly_coins'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function transactions()
   {
      $id_user = Auth::id();
      $transactions = User::find($id_user)->banco()->where('description', '<>', 3)->paginate(9);
      return view('report.transaction', compact('transactions'));
   }

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function poolcommission()
   {
      $id_user = Auth::id();
      $scores = User::find($id_user)->banco()->where('description', 5)->paginate(9);


      return view('report.poolcommission', compact('scores'));
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      //ttttt
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
