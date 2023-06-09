<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function show()
    {
        $all_users = User::withTrashed()->where('role','user')->oldest()->paginate(10);
        
        if ($all_users->isNotEmpty()) {
            return view('admin.users.allusers')->with('all_users', $all_users);
        }
    }
    public function deactivate(User $user)
    {
        $user->delete();
        return redirect()->back();
    }

    public function activate($id)
    {
        User::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }
}
