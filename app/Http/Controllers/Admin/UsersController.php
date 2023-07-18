<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Contact;

class UsersController extends Controller
{
    public function show()
    {
        $all_users = User::withTrashed()->where('role','user')->oldest()->paginate(10);
        
        return view('admin.users.allusers')->with('all_users', $all_users);
        
    }
    public function deactivate(User $user)
{
    $user->meetings()->delete();
    $user->joinMeetings()->detach();

    $user->participant()->delete();

    $reviews = Contact::where('subtitle_id', 5)->where('email', $user->email)->get();
    foreach ($reviews as $review) {
        $review->delete();
    }

    $user->delete();

    return redirect()->back();
}

    public function activate($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        if ($user->self_delete == 1) {
            $user->self_delete = 0;
            $user->save();
        }

        $user->restore();

        return redirect()->back();
    }
}
