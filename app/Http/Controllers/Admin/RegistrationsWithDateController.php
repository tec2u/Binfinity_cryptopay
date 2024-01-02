<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\Admin\SearchRequest;
use App\Http\Controllers\Controller;
use App\Models\OrderPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Models\User;
use App\Traits\CustomLogTrait;
use Illuminate\Support\Facades\DB;


class RegistrationsWithDateController extends Controller
{

    public function index()
    {
    $user_search = User::select(DB::raw('date(created_at) as date' ),DB::raw('count(*) as amount'))
                        ->groupBy(DB::raw('date(created_at)'))
                        ->orderBy(DB::raw('date(created_at)'))
                        ->limit(30)
                        ->get();
   
                        

     foreach ($user_search as $key => $value) {
        
        $dataArray = $value['date'];
       
            $package_search = OrderPackage::select(DB::raw('count(*) as amountPackage'))
                            ->where(DB::raw('date(created_at)'), $dataArray)
                            ->where('status','=',1)
                            ->get();

        $labelsChart[$key] = $value['date'];
        $dataChart[$key] = $value['amount'];

        $data[$key]=["date"=>$value['date'],
                     "amount"=>$value['amount'],
                     "amountPackage"=>$package_search[0]['amountPackage']];
    } 

   
    

   $data=array_reverse($data);
    
    
    return view('admin.reports.RegistrationsWithDate', compact('data','labelsChart','dataChart'));
    
    }
 


}
