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
                'name' => 'Room_1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [ 
                'name' => 'Room_2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [ 
                'name' => 'Room_3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [ 
                'name' => 'Room_4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [ 
                'name' => 'Room_5',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [ 
                'name' => 'Room_6',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        $this->room->insert($rooms);
    }
}
