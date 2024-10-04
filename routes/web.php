<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ChatController::class,'index'])->name('home');
Route::post('/msg', [ChatController::class,'brodmsg'])->name('msg');
Route::post('/usersave', [ChatController::class,'usersave'])->name('usersave');
Route::get('/chat', [ChatController::class,'chat'])->name('chat');
