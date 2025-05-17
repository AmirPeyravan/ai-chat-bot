<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/chat', function () {
    return view('chat');
});

Route::post('/chat', [ChatController::class, 'handleChat']);