<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use App\Models\Level;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class WelcomeController extends Controller
{
    private $contact;
    private $user;
    private $level;

    public function __construct(Contact $contact, User $user, Level $level){
        $this->contact      = $contact;
        $this->user         = $user;
        $this->level        = $level;
    }

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
