<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


// user controller
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;


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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



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

    #LOGINED ADMIN ONLY
    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/',[AdminController::class,'showUsers'])->name('showUsers');
        Route::get('/events',[AdminController::class,'showEvents'])->name('showEvents');
        Route::get('/events/create',[AdminController::class,'createEvent'])->name('createEvent');
        Route::post('/events/store',[AdminController::class,'storeEvent'])->name('storeEvent');

    });
});

