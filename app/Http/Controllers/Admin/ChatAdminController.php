<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\DB;

class ChatAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unanswereds = ChatMessage::where('status', '0')->paginate(9);

        $answereds = ChatMessage::where('status', '1')->paginate(9);

        $closeds = ChatMessage::where('status', '2')->paginate(9);

        return view('admin.support.support', compact('unanswereds', 'answereds', 'closeds'));
    }

    public function answerChat($id)
    {
        $messages = ChatMessage::where('id', $id)->where('status', '!=', '2')->get();

        return view('admin.support.answerChat', compact('messages'));
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

    public function createMessage(Request $request)
    {

        $msg = new Message;
        $msg->chat_id = $request->chat_id;
        $msg->user_id = auth()->user()->id;
        $msg->text = $request->text;
        $msg->date = date('Y-m-d H:i:s');
        $msg->save();

        $cht = Chat::where('id', $request->chat_id)->first();
        $cht->status = 1;
        $cht->save();

        return redirect()->route('admin.support');
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
        //
    }

    public function closeChat($id)
    {
        $cht = Chat::where('id', $id)->first();
        $cht->status = 2;
        $cht->save();

        return redirect()->route('admin.support');
    }

    public function reopenChat($id)
    {
        $cht = Chat::where('id', $id)->first();
        $cht->status = 0;
        $cht->save();

        return redirect()->route('admin.support');
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
