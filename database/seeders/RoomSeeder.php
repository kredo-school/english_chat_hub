<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $room;
    public function __construct(Room $room)
    {
        $this->room = $room;
    }
    public function run()
    {
        $rooms = [
            'Room_1','Room_2','Room_3','Room_4','Room_5','Room_6'
        ];

        foreach ($rooms as $room) {
            $this->room->create(['name' => $room]);
        }
    }
}
