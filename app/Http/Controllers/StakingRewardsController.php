<?php

namespace App\Http\Controllers;

use App\Models\HistoricScore as Score;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StakingRewardsController extends Controller
{

   public function index()
   {
      $id_user  = Auth::id();
      $scores = DB::table('historic_score')
         ->join('users', 'historic_score.user_id', '=', 'users.id')
         ->select(
            'users.name as user_name',
            'historic_score.score',
            'historic_score.orders_package_id',
            'historic_score.description',
            'historic_score.created_at'
         )->whereIn('historic_score.user_id', [$id_user])->get();

      return view('signup_commission', compact('scores'));
   }
}
