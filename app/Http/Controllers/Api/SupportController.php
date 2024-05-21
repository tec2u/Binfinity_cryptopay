<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\NodeOrders;
use App\Traits\ApiUser;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

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
            }

            return response()->json(['data' => $chats]);
        } catch (\Throwable $th) {
            // return response()->json(['error' => $th->getMessage()]);
            return response()->json(['error' => "Failed in get data"]);
        }

    }
}
