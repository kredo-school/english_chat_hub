<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Level;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    private $user;
    private $level;

    public function __construct(User $user, Level $level){
        $this->user = $user;
        $this->level = $level;
    }


    public function follower($id)
    {
        $user = $this->user->findOrFail($id);
        $followers = $user->followers;
        $following  = $user->following;

        return view('users.profile.follower')
        ->with('user', $user)
        ->with('followers', $followers)
        ->with('following', $following);
    }

    public function following($id)
    {
        $user       = $this->user->findOrFail($id);
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
