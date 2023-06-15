<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\User;
use App\Models\Meeting;

class HomeController extends Controller
{
    private $category;
    private $user;
    private $meeting;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Category $category, User $user, Meeting $meeting)
    {
        $this->category = $category;
        $this->user = $user;
        $this->meeting = $meeting;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $all_categories = $this->category->all();
        $user = Auth::user();
        $all_meetings = $this->meeting->all();

        return view('users.top')
        ->with('all_categories', $all_categories)
        ->with('user', $user)
        ->with('all_meetings', $all_meetings);
    }

    public function show(){
        $user = Auth::user();

        return view('users.reserved.show_details')
        ->with('user', $user);
    }
}
