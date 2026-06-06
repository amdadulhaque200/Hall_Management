<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        for ($floor = 1; $floor <= 5; $floor++) {
            for ($room = 1; $room <= 14; $room++) {
                $roomNumber = ($floor * 100) + $room;
                Room::create([
                    'room_number' => (string)$roomNumber,
                    'floor'       => $floor,
                    'capacity'    => 4,
                ]);
            }
        }
    }
}