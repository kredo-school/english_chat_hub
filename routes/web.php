<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\MeetingsController;
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ZoomController;

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

Route::get('/', [WelcomeController::class, 'index'])->name('/');


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
    Route::get('/map', [EventController::class, 'map'])->name('map');
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
        Route::get('/reserved/show/event/{event}/', [HomeController::class, 'showOtherEventJoinMember'])->name('reserved.showOtherEventJoinMember');
        Route::get('/research/show/{category}', [HomeController::class, 'showMeeting'])->name('research.show');
        Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::delete('/profile/delete/{id}', [ProfileController::class, 'destroyProfile'])->name('profile.destroy');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/research/store', [MeetingController::class, 'store'])->name('meeting.store');
        Route::get('/research/edit/{meeting}', [MeetingController::class, 'edit'])->name('meeting.edit');
        Route::patch('/research/update/{meeting}', [MeetingController::class, 'update'])->name('meeting.update');
        Route::delete('/research/delete/{meeting}', [MeetingController::class, 'delete'])->name('meeting.delete');
        Route::post('/research/cancel/{meeting}', [MeetingController::class, 'cancel'])->name('meeting.cancel');
        Route::post('/research/cancel/event/{event}', [EventController::class, 'cancel'])->name('event.cancel');
        Route::post('/research/join/{meeting}', [MeetingController::class, 'join'])->name('meeting.join');
        Route::get('meetings/search/{date}/result', [MeetingController::class, 'result'])->name('meetings.result');
    });

    #LOGINED ADMIN ONLY
    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['prefix'=>'users', 'as'=>'users.'],function(){
            Route::get('/', [UsersController::class, 'show'])->name('show');
            Route::delete('/users/{user}/deactivate', [UsersController::class, 'deactivate'])->name('deactivate');
            Route::patch('/users/{id}/activate', [UsersController::class, 'activate'])->name('activate');
        });
        

        Route::group(['prefix' => 'events', 'as' => 'events.'], function () {
            Route::get('/', [EventsController::class, 'show'])->name('show');
            Route::get('/create', [EventsController::class, 'create'])->name('create');
            Route::post('store', [EventsController::class, 'store'])->name('store');
            Route::get('/{event}/edit/', [EventsController::class, 'edit'])->name('edit');
            Route::patch('/{event}', [EventsController::class, 'update'])->name('update');
            Route::delete('/{event}', [EventsController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/participants',[EventsController::class,'showParticipants'])->name('showParticipants');
        });

        Route::group(['prefix' => 'chatrooms', 'as' => 'chatrooms.'], function () {
            #MEETING
            Route::group(['prefix' => 'meetings', 'as' => 'meetings.'], function () {
                Route::get('/', [MeetingsController::class, 'index'])->name('index');
                Route::get('/{condition}/result', [MeetingsController::class, 'result'])->name('result');
                Route::get('/{id}/edit', [MeetingsController::class, 'edit'])->name('edit');
                Route::patch('/{id}/update', [MeetingsController::class, 'update'])->name('update');
                Route::patch('/{id}/restore', [MeetingsController::class, 'restore'])->name('restore');
                Route::delete('/{meeting}/delete', [MeetingsController::class, 'delete'])->name('delete');
                Route::delete('/{id}/forcedelete', [MeetingsController::class, 'forceDelete'])->name('forceDelete');
            });
            #ROOM
            Route::group(['prefix' => 'rooms', 'as' => 'rooms.'], function () {
                Route::get('/', [RoomsController::class, 'index'])->name('index');
                Route::get('/{id}/show', [RoomsController::class, 'show'])->name('show');
                Route::patch('/{id}/restore', [RoomsController::class, 'restore'])->name('restore');
                Route::delete('/{room}/delete', [RoomsController::class, 'delete'])->name('delete');
                Route::delete('/{room}/deleteZoomAccount', [RoomsController::class, 'deleteZoomAccount'])->name('deleteZoomAccount');
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
            Route::get('/',[ContactsController::class,'show'])->name('show');
            Route::put('/{message}', [ContactsController::class, 'updateStatus'])->name('update_status');
        });
    });
    // ZOOM API
    Route::get('/zoomoauth/check/{room}/', [ZoomController::class, 'zoomOauth']);
});