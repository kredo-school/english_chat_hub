<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     private $level;
     public function __construct(Level $level)
     {
        $this->level = $level;
     }
    public function run()
    {
        $levels = [
            [
                'name' => 'Begginer',
                'icon' => 'begginer.png'
            ],
            [
                'name' => 'intermediate',
                'icon' => 'intermediate.png'
            ],
            [
                'name' => 'advanced',
                'icon' => 'advanced.png'
            ]
        ];

        $this->level->create($levels);
    }
}
