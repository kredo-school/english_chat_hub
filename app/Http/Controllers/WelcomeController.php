<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;


class WelcomeController extends Controller
{
    public function index(){  
        $all_reviews       = Contact::where('subtitle_id', 5)->latest()->paginate(15);
        $urls = [];
        foreach($all_reviews AS $review)
        {
            $image      = User::where('email', $review->email)->first()->level->icon;
            $url        = asset('image/level/'.$image);
            $urls[]     = $url;
        }
  
        return view('welcome')
        ->with('all_reviews', $all_reviews)
        ->with('urls', $urls);
    }
}