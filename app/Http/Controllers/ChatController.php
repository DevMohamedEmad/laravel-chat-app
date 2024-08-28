<?php

namespace App\Http\Controllers;

use App\Events\ChatSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat($receiver_id)
    {
        $receiver = User::find($receiver_id);
        return view('chat', compact('receiver'));
    }

    public function sendMessage(Request $request)
    {
        $data =[
            'sender_id' => auth()->user()->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ];

        Message::create($data);
        // Push notification
        // event(new ChatSent($request->receiver_id, $request->message, auth()->user()->id));

        \broadcast(new ChatSent($request->receiver_id, $request->message, auth()->user()->id));
        return redirect()->back();
    }
}
