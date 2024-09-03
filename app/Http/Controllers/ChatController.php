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
        $chats = Message::where(function ($query) use ($receiver_id) {
            $query->where('sender_id', auth()->user()->id)
                ->where('receiver_id', $receiver_id);
        })->orderBy('id', 'desc')->get();
        
        return view('chat', compact('receiver', 'chats'));
    }

    public function sendMessage(Request $request)
    {
        $data =[
            'sender_id' => auth()->user()->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ];

       $message = Message::create($data);

        \broadcast(new ChatSent($request->receiver_id, $request->message, auth()->user()->id));
        return redirect()->back();
    }
}
