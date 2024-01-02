<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawRequest;
use App\Traits\CustomLogTrait;
use Exception;
use Illuminate\Http\Request;

class WithdrawsAdminController extends Controller
{
    use CustomLogTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdrawRequests()
    {
        $withdraws = WithdrawRequest::orderBy('id', 'DESC')->paginate(9);

        return view('admin.withdraw.withdrawRequests', compact('withdraws'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdrawLog()
    {
        $withdraws = WithdrawRequest::orderBy('id', 'DESC')->where('status', true)->paginate(9);

        return view('admin.withdraw.withdrawLog', compact('withdraws'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $data = $request->only([
            'status',
            'message',
        ]);

        try {

            $data['payment_code'] = "updated annually via admin";

            $user = WithdrawRequest::find($id);

            $user->update($data);
            $this->createLog('Withdraw Requests updated successfully', 200, 'success', auth()->user()->id);

            flash(__("admin_alert.withrequest"))->success();
            return redirect()->route('admin.withdraw.withdrawRequests');
        } catch (Exception $e) {

            $this->errorCatch($e->getMessage(), auth()->user()->id);
            flash(__("admin_alert.withnotrequest"))->error();
            return redirect()->route('admin.withdraw.withdrawRequests');
        }
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
