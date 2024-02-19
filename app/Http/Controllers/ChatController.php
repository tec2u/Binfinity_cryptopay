<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isNull;

class ChatController extends Controller
{
   public function answerChat($id)
   {
      $messages = ChatMessage::where('id', $id)->where('status', '!=', '2')->get();

      return view('answerChatUser', compact('messages'));
   }

   public function createMessage(Request $request)
   {
      $validator = Validator::make($request->all(), [
         'chat_id' => 'required|numeric',
         'text' => 'required',
      ]);

      if ($validator->fails()) {
         return redirect()->route('supports.supporttickets');
      }

      $message = new Message;
      $message->chat_id = $request->chat_id;
      $message->user_id = auth()->user()->id;
      $message->text = $request->text;
      $message->date = now(); // Ou use Carbon para manipulação de datas
      $message->save();

      $cht = Chat::where('id', $request->chat_id)->first();
      $cht->status = 1;
      $cht->save();
      // DB::table('chat')->where("id", $request->chat_id)->update(['status' => 1]);

      return redirect()->route('supports.supporttickets');
   }

   public function closeChat($id)
   {
      DB::table('chat')->where("id", $id)->update(['status' => 2]);

      return redirect()->route('supports.supporttickets');
   }

   public function reopenChat($id)
   {
      DB::table('chat')->where("id", $id)->update(['status' => 0]);

      return redirect()->route('supports.supporttickets');
   }

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $id_user = Auth::id();
      $chats = Chat::where('user_id', $id_user)->paginate(9);
      if (!is_null(Chat::where('user_id', $id_user)->where('status', '1')->first())) {
         Alert::success(__('backoffice_alert.chat_answered'));
      }

      return view('supporttickets', compact('chats'));
   }


   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request)
   {
      $user = User::find(auth()->user()->id);


      try {

         $insertchat = [
            "status" => 0,
            "title" => $request->get('title')
         ];

         $userchat = $user->chat()->create($insertchat);

         $insertmessage = [
            "text" => $request->get('text'),
            "date" => date('Y-m-d H:i:s'),
            "user_id" => $user->id
         ];

         $message = $userchat->message()->create($insertmessage);

         Alert::success(__('backoffice_alert.chat_success'));
         return redirect()->route('supports.supporttickets');
      } catch (Exception $e) {
         Alert::error(__('backoffice_alert.chat_error'));
         return redirect()->back();
      }
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
