<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IpWhitelist;
use App\Traits\CustomLogTrait;
use Illuminate\Http\Request;
use Exception;

class IpWhitelistAdminController extends Controller
{
    use CustomLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function whitelist()
    {
        $whitelist = IpWhitelist::orderBy('created_at', 'DESC')->paginate(9);
        return view('admin.whitelist.withtelist', compact('whitelist'));
    }

      /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.whitelist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'ip',
            'activated',
        ]);

        try {

           $white = IpWhitelist::create($data);

            $this->createLog('WhiteList created successfully', 201, 'success', auth()->user()->id);
            flash(__('admin_alert.wlcreate'))->success();
            return redirect()->route('admin.whitelist.whitelist');
        } catch (Exception $e) {
            flash(__('admin_alert.wlnotcreate'))->error();
            return redirect()->back();
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
            $user = IpWhitelist::find($id);
            $user->activated = false;

            $user->update();
            $this->createLog('User inactive successfully', 204, 'success', auth()->user()->id);
            flash(__('admin_alert.wlinactive'))->success();
            return redirect()->route('admin.whitelist.whitelist');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.wlnotremove'))->error();
            return redirect()->back();
        }
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activated($id)
    {
        try {
            $user = IpWhitelist::find($id);
            $user->activated = true;

            $user->update();
            $this->createLog('WhiteList activated successfully', 204, 'success', auth()->user()->id);
            flash(__('admin_alert.wlactivated'))->success();
            return redirect()->route('admin.whitelist.whitelist');
        } catch (Exception $e) {
            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__('admin_alert.wlnotactivated'))->error();
            return redirect()->back();
        }
    }
}
