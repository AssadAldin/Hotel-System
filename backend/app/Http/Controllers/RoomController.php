<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/rooms",
     *     @OA\Response(response="200", description="Get all rooms")
     * )
     */
    public function index()
    {
        $rooms = Room::all();
        return $rooms;
    }

    /**
     * @OA\Post(
     *     path="/api/rooms",
     *     @OA\RequestBody(
     *         description="Room to create",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="number", type="integer"),
     *             @OA\Property(property="floor", type="integer")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Room created")
     * )
     */
    public function store(Request $request)
    {
        return Room::create([
            'number' => 6,
            'floor' => 10
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
