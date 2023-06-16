<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;



use App\Http\Controllers\ContactController;



// user controller
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/faq', function () {
    return view('faq');
});

Auth::routes();



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Contact Us form
Route::get('/contact-us/create', [ContactController::class, 'create'])->name('contact-us.create');
Route::post('/contact-us/store', [ContactController::class, 'store'])->name('contact-us.store');

// Route Group
Route::group(['middleware' => 'auth'], function () {
    # LOGINED USERS ONLY
    Route::group(['prefix'=>'users','as'=>'users.'], function(){
        Route::get('/', [HomeController::class, 'index'])->name('top');
        Route::get('/reserved/show', [HomeController::class, 'show'])->name('reserved.show.details');
        Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
  
//user event
Route::group(['prefix' => 'events' , 'as' => 'events.'], function(){
    Route::get('/event', [EventController::class, 'show'])->name('show');
    Route::get('/events/{event}', [EventController::class, 'showDetail'])->name('show.detail');
});


    #LOGINED ADMIN ONLY
    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/',[AdminController::class,'showUsers'])->name('showUsers');
        Route::get('/events',[AdminController::class,'showEvents'])->name('showEvents');
        Route::get('/events/create',[AdminController::class,'createEvent'])->name('createEvent');
        Route::post('/events/store',[AdminController::class,'storeEvent'])->name('storeEvent');

    });
});

