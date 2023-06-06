<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->user = $user;

    }

    // Users
    public function showUsers()
    {
        $all_users = $this->user->all();
        return view('admin.users.allusers')->with('all_users',$all_users);
    }
}
