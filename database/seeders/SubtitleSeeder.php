<?php

namespace Database\Seeders;

use App\Models\Subtitle;
use Illuminate\Database\Seeder;

class SubtitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $subtitle;
    public function __construct(Subtitle $subtitle)
    {
        $this->subtitle = $subtitle;
    }
    public function run()
    {
        $subtitles = [
            [
                'name' => 'Report',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'How to use',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Event',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Other',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        $this->subtitle->insert($subtitles);
    }
}
