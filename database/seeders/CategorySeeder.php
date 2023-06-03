<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
        [
            'name' => 'Music',
            'icon' => 'music.png',
            'color' => 'FABD00',
            'description' => 'Are you a music lover?  What is your favorite?'
        ],
        [
            'name' => 'Travel',
            'icon' => 'travel.png',
            'color' => '00A6D9',
            'description' => 'Where did you go? Where do you want to go?'
        ],
        [
            'name' => 'Hobby',
            'icon' => 'hobby.png',
            'color' => '4B3024',
            'description' => 'What are you into now? Share what you like!'
        ],
        [
            'name' => 'SOCIAL ISSUE',
            'icon' => 'social_issue.png',
            'color' => '28A838',
            'description' => 'How can we do to solve social issues? '
        ],
        [
            'name' => 'Sports',
            'icon' => 'sports.png',
            'color' => 'ED6A02',
            'description' => 'What is your favorite sport?  Do you watch or play?'
        ],
        [
            'name' => 'Movie',
            'icon' => 'movie.png',
            'color' => '6D6C6C',
            'description' => 'What is your favorite movie?  Or not so cool movie?  '
        ],
        [
            'name' => 'Emotion',
            'icon' => 'emotion.png',
            'color' => 'D6455E',
            'description' => 'Happy? Sad?? Share your feelings.'
        ],
        [
            'name' => 'Love',
            'icon' => 'love.png',
            'color' => 'E5001E',
            'description' => 'Share your love life;-) '
        ],
        [
            'name' => 'Other',
            'icon' => 'other.png',
            'color' => '003067',
            'description' => 'Anything you like!!'
        ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
