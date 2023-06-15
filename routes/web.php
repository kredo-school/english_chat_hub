<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\MeetingsController;
use App\Http\Controllers\Admin\RoomsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\ContactController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Contact Us form
Route::get('/contact-us/create', [ContactController::class, 'create'])->name('contact-us.create');
Route::post('/contact-us/store', [ContactController::class, 'store'])->name('contact-us.store');

// Route Group
Route::group(['middleware' => 'auth'], function () {
    # LOGINED USERS ONLY

    #LOGINED ADMIN ONLY
    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/',[AdminController::class,'showUsers'])->name('showUsers');
        Route::get('/events',[AdminController::class,'showEvents'])->name('showEvents');
        Route::get('/events/create',[AdminController::class,'createEvent'])->name('createEvent');
        Route::post('/events/store',[AdminController::class,'storeEvent'])->name('storeEvent');
        Route::group(['prefix' => 'chatroom', 'as' => 'chatroom.'], function () {
            #MEETING
            Route::group(['prefix' => 'meeting', 'as' => 'meeting.'], function () {
                Route::get('/', [MeetingsController::class, 'index'])->name('index');
                Route::get('/{id}/edit', [MeetingsController::class, 'edit'])->name('edit');
                Route::patch('/{id}/update', [MeetingsController::class, 'update'])->name('update');
                Route::patch('/{id}/restore', [MeetingsController::class, 'restore'])->name('restore');
                Route::delete('/{id}/delete', [MeetingsController::class, 'delete'])->name('delete');
            });
            #ROOM
            Route::group(['prefix' => 'room', 'as' => 'room.'], function () {
                Route::get('/', [RoomsController::class, 'index'])->name('index');
                Route::get('/{id}/show', [RoomsController::class, 'show'])->name('show');
                Route::patch('/{id}/restore', [RoomsController::class, 'restore'])->name('restore');
                Route::delete('/{id}/delete', [RoomsController::class, 'delete'])->name('delete');
            });
            #CATEGORIES
            Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
                Route::get('/', [CategoriesController::class, 'index'])->name('index');
                Route::get('/add', [CategoriesController::class, 'add'])->name('add');
                Route::get('/{id}/show', [CategoriesController::class, 'show'])->name('show');
                Route::get('/{id}/edit', [CategoriesController::class, 'edit'])->name('edit');
                Route::post('/store', [CategoriesController::class, 'store'])->name('store');
                Route::patch('/{id}/update', [CategoriesController::class, 'update'])->name('update');
                Route::patch('/{id}/restore', [CategoriesController::class, 'restore'])->name('restore');
                Route::delete('/{id}/delete', [CategoriesController::class, 'delete'])->name('delete');
            });
        });
    });
});
