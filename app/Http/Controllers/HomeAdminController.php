<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banco;
use App\Models\User;
use App\Models\WithdrawRequest;
use App\Models\Investment;
use App\Models\HistoricScore;
use Illuminate\Support\Facades\DB;
use App\Models\OrderPackage;
use Khill\Lavacharts\Lavacharts;


use Illuminate\Http\Request;

class HomeAdminController extends Controller
{
   //  /**
   //   * Create a new controller instance.
   //   *
   //   * @return void
   //   */
   //  public function __construct()
   //  {
   //      $this->middleware('auth');
   //  }

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function indexAdmin()
   {
      $users = User::orderBy('id', 'DESC')->where('activated', true)->paginate(7);
      $usersCont = User::count();
      $withdrawSum = WithdrawRequest::where('status',1)->sum('value');

      $bonususer1 = Banco::where('description', 2)
         ->selectRaw('sum(price) as total')
         ->first();

      $bonususer2 = Banco::where('description', 1)
         ->selectRaw('sum(price) as total')
         ->first();


      $poll = HistoricScore::where('description', "9")->sum('score');

      $specialCommision = HistoricScore::where('description', "8")->sum('score');

      $userpay = OrderPackage::where('status', 1)->where('payment_status', 1)->distinct()->get(['user_id'])->count();

      $cards = DB::table('packages')
      ->where('packages.type','!=','activator')
      ->where('packages.activated',1)
      ->leftJoin('users', 'users.id_card', 'packages.id')
      ->selectRaw('packages.name, packages.img, count(users.id_card) as count')
      ->groupBy('users.id_card')
      ->groupBy('packages.name')
      ->groupBy('packages.img')
 
      ->get();

      $countcard = [['Cards', 'Total']];
      foreach ($cards as $item) {
         array_push($countcard, [$item->name , $item->count]);
      }
      $countcard = json_encode($countcard);

      if (empty($bonususer1)) {
         $totalbanco1 = 0;
      } else {
         $totalbanco1 = $bonususer1->total;
      }

      if (empty($bonususer2)) {
         $totalbanco2 = 0;
      } else {
         $totalbanco2 = $bonususer2->total;
      }

      $commissionSum = $totalbanco1 + $totalbanco2;

      $orderpackages = OrderPackage::select(DB::raw('orders_package.id as id'),DB::raw('orders_package.created_at as created_at'),DB::raw('users.name as name'),
      DB::raw('orders_package.user as user'),DB::raw('orders_package.price as price'),DB::raw('orders_package.pass as pass'),DB::raw('orders_package.status as status'))
      ->orderBy('orders_package.id', 'DESC')
      ->join('users', 'users.id', '=', 'orders_package.user_id')
      ->paginate(20);

      #	User	Server Config	Value	Order Created	Status
      //dd($orderpackages);
      

      $lava = new Lavacharts;
      $popularity = $lava->DataTable();
      $data = DB::table('users')
      ->select(DB::raw('country , count(country) as countcountry'))
      ->groupBy('country')
      ->get()->toArray();
      
      $countcountry = [];
      foreach ($data as $item) {
         array_push($countcountry, [$item->country , $item->countcountry]);
      }

      $popularity->addStringColumn('Country')
         ->addNumberColumn('Users')
         ->addRows($countcountry);
      $lava->GeoChart('Popularity', $popularity, [
         'colorAxis'                 =>  ['minValue' => 0,  'colors' => ['#daa520', '#ae841a']],   
         'displayMode'               => 'auto',
         'enableRegionInteractivity' => true,
         'keepAspectRatio'           => true,
         'region'                    => 'world',
         'resolution'                => 'countries',
         'sizeAxis'                  => null,
         'legend'                    => 'none',
      ]);

      return view('admin.homeAdmin', ['lava' => $lava])->with(compact('users', 'usersCont', 'withdrawSum', 'commissionSum', 'orderpackages', 'lava','cards','countcard','poll','specialCommision','userpay'));
   }
}
