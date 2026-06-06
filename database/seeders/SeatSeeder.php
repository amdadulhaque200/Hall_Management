<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    public function run(): void
    {
        $rooms = Room::all();
        foreach ($rooms as $room) {
            for ($bed = 1; $bed <= 4; $bed++) {
                Seat::create([
                    'room_id'     => $room->id,
                    'seat_number' => 'Bed' . $bed,
                    'student_id'  => null,
                    'status'      => 'available',
                ]);
            }
        }
    }
}