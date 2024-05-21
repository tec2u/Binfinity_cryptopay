<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\NodeOrders;
use App\Traits\ApiUser;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class SupportController extends Controller
{
    use ApiUser;
    public function supportList(Request $request)
    {
        try {
            $user = $this->getUser($request);
            if ($user == false) {
                return response()->json(['error' => "Invalid token"]);
            }


            $id_user = $user->id;
            $chats = Chat::where('user_id', $id_user)->get();
            foreach ($chats as $chat) {
                if ($chat->status == 0) {
                    $chat->status = "Sent";
                } else if ($chat->status == 1) {
                    $chat->status = "Answered";
                } else {
                    $chat->status = "Finished";
                }

                foreach ($chat->message as $msg) {
                    $chat->message = $msg->text;
                }
            }

            return response()->json(['data' => $chats]);
        } catch (\Throwable $th) {
            // return response()->json(['error' => $th->getMessage()]);
            return response()->json(['error' => "Failed in get data"]);
        }

    }

    public function supportStore(Request $request)
    {
        try {
            $user = $this->getUser($request);
            if ($user == false) {
                return response()->json(['error' => "Invalid token"]);
            }

            $validatedData = Validator::make($request->all(), [
                'title' => 'required|string',
                'text' => 'required|string',
            ]);

            if ($validatedData->fails()) {
                return response()->json(['error' => $validatedData->errors()], 422);
            }

            $insertchat = [
                "status" => 0,
                "title" => $request->title
            ];

            $userchat = $user->chat()->create($insertchat);

            $insertmessage = [
                "text" => $request->text,
                "date" => date('Y-m-d H:i:s'),
                "user_id" => $user->id
            ];

            $userchat->message()->create($insertmessage);


            $id_user = $user->id;
            $chats = Chat::where('user_id', $id_user)->get();
            foreach ($chats as $chat) {
                if ($chat->status == 0) {
                    $chat->status = "Sent";
                } else if ($chat->status == 1) {
                    $chat->status = "Answered";
                } else {
                    $chat->status = "Finished";
                }

                foreach ($chat->message as $msg) {
                    $chat->message = $msg->text;
                }
            }

            return response()->json(['data' => $chats]);

        } catch (\Throwable $th) {
            return response()->json(['error' => "Failed in get data"]);
        }
    }
}
