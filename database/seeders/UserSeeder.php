<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        User::create([
            'full_name' => 'The Admin',
            'user_name' => 'The Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin'
        ]);
    }
}
