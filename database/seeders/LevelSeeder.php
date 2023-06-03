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

        foreach ($levels as $level) {
            Level::create($level);
        }
    }
}
