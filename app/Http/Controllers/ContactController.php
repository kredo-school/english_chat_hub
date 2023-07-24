<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Subtitle;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUsMail;


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
            'email'         => 'required|email|max:50',
            'title'         => 'required|max:50',
            'content'       => 'required|max:1000',
            'rating'        => ($request->subtitle_id == 5) ? 'required|integer' : 'nullable',
            'subtitle_id'   => 'required',
        ]);

        $user = $request->user();
        $this->contact->name        = $request->name ?? $user->user_name;
        $this->contact->email       = $request->email ?? $user->email;
        $this->contact->content     = $request->content;
        $this->contact->rating      = $request->rating;
        $this->contact->title       = $request->title;
        $this->contact->subtitle_id = $request->subtitle_id;
        $this->contact->save();

        $contactMail = new ContactUsMail($this->contact);
        Mail::to($this->contact->email)->send($contactMail);

        $request->session()->flash('success', true);

        return redirect()->back();
    }
}
