<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
 //   return view('welcome');
//});

Route::get('/',[HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'account'],function(){
   //Guest route
     Route::group(['middleware' => 'guest'],function(){
        Route::get('/register', [AccountController::class, 'registration'])->name('account.registration');
        Route::post('/process-register', [AccountController::class, 'processRegistration'])->name('account.processRegistration');
        Route::get('/login', [AccountController::class, 'login'])->name('account.login');
        Route::post('/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
     });
        //Authenticated Routes
        Route::group(['middleware' => 'auth'], function () {
            Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
            Route::put('/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
            Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
        });
});
