<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConfigBonusunilevel;
use App\Traits\CustomLogTrait;
use App\Traits\OrderBonusTrait;
use App\Traits\PaymentLogTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigBonusController extends Controller
{
    use CustomLogTrait, PaymentLogTrait, OrderBonusTrait;

    public function index()
    {
        $bonus_All = ConfigBonusunilevel::orderBy('id')->get();

        return view('admin.configBonus.list', compact('bonus_All'));
    }

    public function create()
    {
        return view('admin.configBonus.create');
    }

    public function store(Request $request)
    {
        $data = $request->only([
            'level',
            'decription',
            'value_percent',
            'user_activated',
            'max_price',
            'status',
            'minimum_users',
        ]);

        try {
            $config = ConfigBonusunilevel::create($data);
            $this->createLog('Config created successfully', 201, 'success', auth()->user()->id);
            flash(__('admin_alert.configcreate'))->success();
            return redirect()->route('admin.configBonus.list');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.confignotcreate'))->error();
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $config = ConfigBonusunilevel::find($id);

        return view('admin.configBonus.edit', compact('config'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->only([
            'level',
            'decription',
            'value_percent',
            'user_activated',
            'max_price',
            'status',
            'minimum_users',
        ]);

        try {
            $config = ConfigBonusunilevel::find($id);
            $config->update($data);
            $this->createLog('Config_Bonus updated successfully', 200, 'success', auth()->user()->id);
            flash(__("admin_alert.configurationupdate"))->success();
            return redirect()->route('admin.configBonus.list');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__("admin_alert.configurationotnupdate"))->error();
            return redirect()->route('admin.configBonus.list');
        }
    }

    public function inactivate($id)
    {
        try {
            $config = ConfigBonusunilevel::find($id);
            $config->status = 0;
            $config->update();
            $this->createLog('Config_Bonus removed successfully', 204, 'success', auth()->user()->id);
            flash(__('admin_alert.configremove'))->success();
            return redirect()->route('admin.configBonus.list');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.confignotremove'))->error();
            return redirect()->back();
        }
    }

    public function activate($id)
    {
        try {
            $config = ConfigBonusunilevel::find($id);
            $config->status = 1;

            $config->update();
            $this->createLog('Config_Bonus updated successfully', 204, 'success', auth()->user()->id);
            flash(__('admin_alert.configurationupdate'))->success();
            return redirect()->route('admin.configBonus.list');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.configurationotnupdate'))->error();
            return redirect()->back();
        }
    }

    public function inactivateall()
    {
        try {

            $config = DB::table('config_bonusunilevel')->update(array('status' => 0));
           
            $this->createLog('Config_Bonus updated successfully', 204, 'success', auth()->user()->id);
            flash(__('admin_alert.configurationupdate'))->success();
            return redirect()->route('admin.configBonus.list');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.configurationotnupdate'))->error();
            return redirect()->back();
        }
    }

    public function activateall()
    {
        try {
            $config = DB::table('config_bonusunilevel')->update(array('status' => 1));

            $this->createLog('Config_Bonus updated successfully', 204, 'success', auth()->user()->id);
            flash(__('admin_alert.configurationupdate'))->success();
            return redirect()->route('admin.configBonus.list');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.configurationotnupdate'))->error();
            return redirect()->back();
        }
    }
}
