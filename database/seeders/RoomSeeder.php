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
            [ 
                'name' => 'Room_1'
            ],
            [ 
                'name' => 'Room_2'
            ],
            [ 
                'name' => 'Room_3'
            ],
            [ 
                'name' => 'Room_4'
            ],
            [ 
                'name' => 'Room_5'
            ],
            [ 
                'name' => 'Room_6'
            ]
        ];

        $this->room->create($rooms);
    }
}
