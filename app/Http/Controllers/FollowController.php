<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{

    public function follower(User $user)
    {
        $followers = $user->followers;
        $following  = $user->following;

        return view('users.profile.follower')
        ->with('user', $user)
        ->with('followers', $followers)
        ->with('following', $following);
    }

    public function following(User $user)
    {
        $followers  = $user->followers;
        $following  = $user->following;

        return view('users.profile.following')
        ->with('user', $user)
        ->with('followers', $followers)
        ->with('following', $following);
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
