<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\MeetingsController;
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MeetingController; 

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

Route::get('/privacy_policy', function () {
    return view('privacy');
})->name('privacy');

Route::get('terms_of_service', function () {
    return view('terms');
})->name('terms');

Auth::routes();

// Contact Us form
Route::get('/contact-us/create', [ContactController::class, 'create'])->name('contact-us.create');
Route::post('/contact-us/store', [ContactController::class, 'store'])->name('contact-us.store');

//user event
Route::group(['prefix' => 'events' , 'as' => 'events.'], function(){
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('/{event}/show', [EventController::class, 'show'])->name('show');
    Route::get('/{event_id}/join', [EventController::class, 'joinForm'])->name('joinForm');
    Route::post('/{event_id}/store', [EventController::class, 'storeGuest'])->name('storeGuest');
});
    Route::group(['middleware' => 'auth'], function(){
        Route::group(['prefix' => 'events' , 'as' => 'events.'], function(){
            Route::post('/{event_id}/storeAuth',[EventController::class, 'storeAuth'])->name('storeAuth');
            Route::delete('/{event_id}/delete',[EventController::class,'destroyAuthParticipant'])->name('destroyAuthParticipant');        
        });
    });

// Route Group
Route::group(['middleware' => 'auth'], function () {
    # LOGINED USERS ONLY
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('top');
        Route::get('/reserved/show', [HomeController::class, 'show'])->name('reserved.show.details');
        Route::get('/reserved/show/{meeting}', [HomeController::class, 'showUser'])->name('reserved.show.users');
        Route::get('/research/show/{category}', [HomeController::class, 'showMeeting'])->name('research.show');
        Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/research/create', [MeetingController::class, 'create'])->name('meeting.create');
        Route::post('/research/store', [MeetingController::class, 'store'])->name('meeting.store');
    });

    #LOGINED ADMIN ONLY
    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', [AdminController::class, 'showUsers'])->name('showUsers');
        Route::delete('/users/{user}/deactivate', [AdminController::class, 'deactivate'])->name('users.deactivate');
        Route::patch('/users/{id}/activate', [AdminController::class, 'activate'])->name('users.activate');

        Route::group(['prefix' => 'events'], function () {
            Route::get('/', [AdminController::class, 'showEvents'])->name('showEvents');
            Route::get('/create', [AdminController::class, 'createEvent'])->name('createEvent');
            Route::post('store', [AdminController::class, 'storeEvent'])->name('storeEvent');
            Route::get('/{event}/edit/', [AdminController::class, 'editEvent'])->name('editEvent');
            Route::patch('/{event}', [AdminController::class, 'updateEvent'])->name('updateEvent');
            Route::delete('/{event}', [AdminController::class, 'destroyEvent'])->name('destroyEvent');
            Route::get('/{id}/participants',[AdminController::class,'showParticipants'])->name('showParticipants');
        });

        Route::group(['prefix' => 'chatrooms', 'as' => 'chatrooms.'], function () {
            #MEETING
            Route::group(['prefix' => 'meetings', 'as' => 'meetings.'], function () {
                Route::get('/', [MeetingsController::class, 'index'])->name('index');
                Route::get('/{id}/edit', [MeetingsController::class, 'edit'])->name('edit');
                Route::patch('/{id}/update', [MeetingsController::class, 'update'])->name('update');
                Route::patch('/{id}/restore', [MeetingsController::class, 'restore'])->name('restore');
                Route::delete('/{meeting}/delete', [MeetingsController::class, 'delete'])->name('delete');
            });
            #ROOM
            Route::group(['prefix' => 'rooms', 'as' => 'rooms.'], function () {
                Route::get('/', [RoomsController::class, 'index'])->name('index');
                Route::get('/{id}/show', [RoomsController::class, 'show'])->name('show');
                Route::patch('/{id}/restore', [RoomsController::class, 'restore'])->name('restore');
                Route::delete('/{room}/delete', [RoomsController::class, 'delete'])->name('delete');
            });
            #CATEGORIES
            Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
                Route::get('/', [CategoriesController::class, 'index'])->name('index');
                Route::get('/add', [CategoriesController::class, 'add'])->name('add');
                Route::get('/{id}/show', [CategoriesController::class, 'show'])->name('show');
                Route::get('/{id}/edit', [CategoriesController::class, 'edit'])->name('edit');
                Route::post('/store', [CategoriesController::class, 'store'])->name('store');
                Route::patch('/{id}/update', [CategoriesController::class, 'update'])->name('update');
                Route::patch('/{id}/restore', [CategoriesController::class, 'restore'])->name('restore');
                Route::delete('/{category}/delete', [CategoriesController::class, 'delete'])->name('delete');
            });
        });

        Route::group(['prefix' => 'inbox', 'as' => 'inbox.'],function(){
            Route::get('/',[AdminController::class,'showInbox'])->name('show');
            Route::put('/{id}', [AdminController::class, 'updateStatus'])->name('update_status');
        });
    });
});

