<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/chat/{receiver_id}', [App\Http\Controllers\ChatController::class, 'chat'])->name('chat')->middleware('auth');
Route::post('/send-message', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('send.message')->middleware('auth');
