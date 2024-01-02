<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IpBlacklist;
use App\Models\IpPool;
use App\Traits\CustomLogTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class IpBlacklistAdminController extends Controller
{
    use CustomLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function blacklist()
    {
        $whitelist = IpBlacklist::orderBy('created_at', 'DESC')->paginate(9);
        return view('admin.blacklist.blacklist', compact('whitelist'));
    }

       /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $ipblack = IpBlacklist::findOrFail($id);
        $ippool = IpBlacklist::where('ip', $ipblack->ip)->get();
        DB::table('ip_pool')->whereIn('ip', $ippool->pluck('ip'))->delete();
        IpBlacklist::where('ip', $ipblack->ip)->delete();
        flash(__('admin_alert.ipblackdelete'))->success();
        return redirect()->back();
        }
}
