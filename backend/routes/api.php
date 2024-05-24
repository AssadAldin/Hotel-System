<?php

use Illuminate\Http\Request;
use App\Models\Room;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Rooms
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms');
Route::post('/rooms', function () {
    return Room::create([
        'number' => 5,
        'floor' => 10
    ]);
});
