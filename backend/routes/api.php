<?php

use Illuminate\Http\Request;
use App\Models\Room;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Rooms
Route::get('/rooms', [RoomController::class, 'index']);
Route::post('/rooms', [RoomController::class,'store']);
Route::put('/rooms/{id}', [RoomController::class, 'update']);
Route::get('/rooms/{id}', [RoomController::class, 'get']);
Route::delete('/rooms/{id}', [RoomController::class, 'destroy']);
