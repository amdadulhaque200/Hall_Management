<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;

class RoomPlanController extends Controller
{
    public function index()
    {
        $floors = [];
        $roomData = [];

        for ($f = 1; $f <= 5; $f++) {
            $rooms = Room::where('floor', $f)
                ->with(['seats.student'])
                ->orderBy('room_number')
                ->get();

            $floors[$f] = $rooms;

            $roomData[$f] = $rooms->map(function($room) {
                return [
                    'id'          => $room->id,
                    'room_number' => $room->room_number,
                    'seats'       => $room->seats->map(function($seat) {
                        return [
                            'seat_number' => $seat->seat_number,
                            'status'      => $seat->status,
                            'student'     => $seat->student ? $seat->student->name : null,
                            'border'      => $seat->student ? $seat->student->border_number : null,
                            'department'  => $seat->student ? $seat->student->department : null,
                            'session'     => $seat->student ? $seat->student->session : null,
                            'phone'       => $seat->student ? $seat->student->phone : null,
                        ];
                    })->values()->toArray(),
                ];
            })->values()->toArray();
        }

        return view('admin.room-plan', compact('floors', 'roomData'));
    }
}