<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    public function index(){  
        $all_reviewers       = Contact::where('subtitle_id', 5)->latest()->paginate(3);
        $users               = [];

        foreach($all_reviewers AS $reviewer){
            $users[]=User::where('email', $reviewer->email)->first();
        }

        return view('welcome')
        ->with('all_reviewers', $all_reviewers)
        ->with('users', $users);
    }
}
