<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/rooms",
     *     tags={"Rooms"},
     *     summary="Get all rooms",
     *     description="Retrieve a list of all rooms",
     *     @OA\Response(
     *         response=200,
     *         description="Rooms retrieved successfully",
     *     )
     * )
     */
    public function index()
    {
        $rooms = Room::all();

        return response()->json(['success' => true, 'data' => $rooms], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/rooms",
     *     tags={"Rooms"},
     *     @OA\RequestBody(
     *         description="Room to create",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="number", type="integer"),
     *             @OA\Property(property="floor", type="integer")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Room created successfully")
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string',
            'floor' => 'required|integer',
        ]);

        $room = new Room();
        $room->number = $request->input('number');
        $room->floor = $request->input('floor');
        $room->save();

        return response()->json(['success' => true, 'data' => $room], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/rooms/{id}",
     *     tags={"Rooms"},
     *     summary="Get a room by ID",
     *     description="Retrieve a specific room by its ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the room to retrieve",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Room not found"
     *     )
     * )
     */
    public function get($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json(['success' => false, 'message' => 'Room not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $room], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/rooms/{id}",
     *     tags={"Rooms"},
     *     summary="Update a room",
     *     description="Update room details",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the room to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"number", "floor"},
     *             @OA\Property(property="number", type="string", example="101"),
     *             @OA\Property(property="floor", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Room not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'number' => 'required|string',
            'floor' => 'required|integer',
        ]);

        $room = Room::find($id);

        if (!$room) {
            return response()->json(['success' => false, 'message' => 'Room not found'], 404);
        }

        $room->number = $request->input('number');
        $room->floor = $request->input('floor');
        $room->save();

        return response()->json(['success' => true, 'data' => $room], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/rooms/{id}",
     *     tags={"Rooms"},
     *     summary="Delete a room by ID",
     *     description="Delete a specific room by its ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the room to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Room not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        $room = Room::find($id);

        if (!$room) {
            return response()->json(['success' => false, 'message' => 'Room not found'], 404);
        }

        $room->delete();

        return response()->json(['success' => true, 'message' => 'Room deleted successfully'], 200);
    }
}
