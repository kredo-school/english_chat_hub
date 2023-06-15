<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');













// Route Group
Route::group(['middleware' => 'auth'], function () {
    # LOGINED USERS ONLY

    #LOGINED ADMIN ONLY
    Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/',[AdminController::class,'showUsers'])->name('showUsers');
        Route::group(['prefix' => 'events'],function(){
            Route::get('/',[AdminController::class,'showEvents'])->name('showEvents');
            Route::get('/create',[AdminController::class,'createEvent'])->name('createEvent');
            Route::post('store',[AdminController::class,'storeEvent'])->name('storeEvent');
            Route::get('edit/{event}',[AdminController::class,'editEvent'])->name('editEvent');
            Route::patch('/{event}',[AdminController::class,'updateEvent'])->name('updateEvent');
            Route::delete('/{event}',[AdminController::class,'destroyEvent'])->name('destroyEvent');
        });
    });
});

