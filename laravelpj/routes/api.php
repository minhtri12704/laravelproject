<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ChatMessage;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::get('/chat/messages', function (Request $request) {
    return ChatMessage::with('user:id,name') // lấy user name thôi cho nhẹ
        ->where('customer_id', $request->customer_id)
        ->orderBy('created_at')
        ->get(['id', 'user_id', 'message', 'created_at', 'customer_id']);
});




