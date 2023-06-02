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
                'name' => 'Report'
            ],
            [
                'name' => 'How to use'
            ],
            [
                'name' => 'Event'
            ],
            [
                'name' => 'Other'
            ]
        ];

        $this->subtitle->create($subtitles);
    }
}
