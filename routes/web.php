<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
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

    });
});

