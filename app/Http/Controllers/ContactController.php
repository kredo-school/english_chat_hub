<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Subtitle;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ContactController extends Controller
{
    private $contact;
    private $subtitle;

    private $user;

    public function __construct(Contact $contact, Subtitle $subtitle, User $user){
        $this->contact      = $contact;
        $this->subtitle     = $subtitle;
        $this->user         = $user;
    }

    
    public function create(){  
        $all_subtitles = $this->subtitle->all();
        $user = Auth::user();
        return view('contact-us')
        ->with('all_subtitles', $all_subtitles)
        ->with('user', $user);
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|max:50',
            'email'         => 'required|email|max:50|unique:users,email',
            'title'         => 'required|max:50',
            'content'       => 'max:1000',
            'subtitle_id'   => 'required',
        ]);

        $this->contact->name        = $request->name;
        $this->contact->email       = $request->email;
        $this->contact->content     = $request->content;
        $this->contact->title       = $request->title;
        $this->contact->subtitle_id = $request->subtitle_id;
        $this->contact->save();

        $request->session()->flash('success', true);

        return redirect()->back();
    }
}
