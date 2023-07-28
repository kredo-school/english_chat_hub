<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function profilePage(User $user)
    {
        $followers = $user->followers;
        $following  = $user->following;

        return view('users.profile.profile-page', compact('user', 'followers', 'following'));
    }

    public function follow($user_id)
    {
        Auth::user()->followers()->attach($user_id);
        return redirect()->back();
    }

    public function unfollow($user_id)
    {
        Auth::user()->followers()->detach($user_id);
        return redirect()->back();
    }
}
