@extends('layouts.app')
@section('styles')
@include('layouts.chat.css')
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Chat With {{ $receiver->name }}</div>

                <div class="card-body">
                    <section class="msger">
                        <header class="msger-header">
                            <div class="msger-header-title">
                                <i class="fas fa-comment-alt"></i> SimpleChat
                            </div>
                            <div class="msger-header-options">
                                <span><i class="fas fa-cog"></i></span>
                            </div>
                        </header>

                        <main class="msger-chat">
                            @foreach($chats as $chat)
                            @if($chat->receiver_id == auth()->user()->id)
                            <div class="msg right-msg">
                                <div class="msg-bubble">
                                    <div class="msg-info">
                                        <div class="msg-info-name">{{ auth()->user()->name }}</div>
                                        <div class="msg-info-time">12:46</div>
                                    </div>

                                    <div class="msg-text">
                                        You can change your name in JS section!
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="msg left-msg">
                                <div class="msg-bubble">
                                    <div class="msg-info">
                                        <div class="msg-info-name">{{ $receiver->name }}</div>
                                        <div class="msg-info-time">12:45</div>
                                    </div>

                                    <div class="msg-text">
                                        Hi, welcome to SimpleChat! Go ahead and send me a message. 😄
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach

                        </main>

                        <form class="msger-inputarea">
                            <input type="text" class="msger-input" placeholder="Enter your message...">
                            <button type="submit" class="msger-send-btn">Send</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@include('layouts.chat.js')
@endsection
