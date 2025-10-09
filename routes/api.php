<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::post('/chat', [ChatController::class, 'store']);
Route::get('/jadwal', [ChatController::class, 'jadwal']);
Route::get('/layanan', [ChatController::class, 'layanan']);
Route::post('/chat/reply', [ChatController::class, 'reply']);

Route::get('/dashboard/data', [ChatController::class, 'getData']);


// return response()->json(['status' => 'success']);