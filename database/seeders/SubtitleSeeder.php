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
    public function run()
    {
        $subtitles = [
            'Report', 'How to use', 'Event', 'Other', 'Review'
        ];

        foreach ($subtitles as $subtitle) {
            Subtitle::create(['name' => $subtitle]);
        }
    }
}
