<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PercentageRegisterRequest;
use App\Models\DailyPercentage;
use App\Traits\CustomLogTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PercentageAdminController extends Controller
{
    use CustomLogTrait;

    protected $dailyPercentage;
    private function  statusChange($status){
        if($status == 1){
            $update = DailyPercentage::where('status', 1)->first();
            if($update){
                $update->update(['status' => 0]);
            }
        }
    }
    public function __construct(DailyPercentage $dailyPercentage)
    {
        $dailyPercentage = $dailyPercentage;
    }
    public function index()
    {
        $bonus_All = DailyPercentage::orderBy('status','desc')->get();
        return view('admin.dailyBonus.list', compact('bonus_All'));
    }

    public function create()
    {
        $count = DailyPercentage::count();
        if($count > 3){
            flash("Percentage limit edit existing")->error();
            return redirect()->back();
        }
        return view('admin.dailyBonus.create');
    }



    public function inactivate($id)
    {
        try {
            $config = DailyPercentage::find($id);
            $config->status = 0;
            $config->updated_at = date("d-m-Y H:i:s");
            $config->update();
            $this->createLog('Daily Bonus removed successfully', 204, 'success', auth()->user()->id);
            flash(__('admin_alert.configremove'))->success();
            return redirect()->route('admin.bonus-daily.list');
        } catch (\Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.confignotremove'))->error();
            return redirect()->back();
        }
    }

    public function activate($id)
    {
        try {
            DB::beginTransaction();
            $this->statusChange(1);
            $config = DailyPercentage::find($id);
            $config->status = 1;
            $config->updated_at = date("Y-m-d H:i:s");
            $config->update();
            $this->createLog('Daily Bonus updated successfully', 204, 'success', auth()->user()->id);
            flash(__('admin_alert.configurationupdate'))->success();
            DB::commit();
            return redirect()->route('admin.bonus-daily.list');
        } catch (\Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.configurationotnupdate'))->error();
            return redirect()->back();
        }
    }


    public function store(PercentageRegisterRequest $percentageRegisterRequest){
   
        try {
            DB::beginTransaction();
            $this->statusChange($percentageRegisterRequest->status);
            DailyPercentage::create([
                'value_perc' => $percentageRegisterRequest->value_perc,
                'status' => $percentageRegisterRequest->status,
                'user_id' => auth()->user()->id,
                'created_at' => date("Y-m-d H:i:s")

            ]);
            $this->createLog('Daily Bonus added successfully', 204, 'success', auth()->user()->id);
            flash(__('admin_alert.configcreate'))->success();
            DB::commit();
            return redirect()->route('admin.bonus-daily.list');
        } catch (\Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.configcreate'))->error();
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $config = DailyPercentage::find($id);
        return view('admin.dailyBonus.edit', compact('config'));
    }

    public function update(Request $request, $id)
    {
        try {
            $config = DailyPercentage::find($id);
            $config->update([
                'value_perc' => $request->value_perc,
                'status' => $request->status,
                'user_id' => auth()->user()->id,
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            $this->createLog('Daily Bonus updated successfully', 200, 'success', auth()->user()->id);
            flash(__("admin_alert.configurationupdate"))->success();
               return redirect()->route('admin.bonus-daily.list');
        } catch (\Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__("admin_alert.configurationotnupdate"))->error();
               return redirect()->route('admin.bonus-daily.list');
        }
    }
}
