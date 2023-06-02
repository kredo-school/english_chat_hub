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

    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function run()
    {
        $this->user->full_name = 'The Admin';
        $this->user->user_name = 'The Admin';
        $this->user->email = 'admin@admin.com';
        $this->user->password = Hash::make('admin12345');
        $this->user->role_id = 1;
        $this->user->created_at = now();
        $this->user->updated_at = now();
        $this->user->save();
    }
}
