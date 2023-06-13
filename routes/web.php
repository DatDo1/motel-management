<?php

use App\Http\Controllers\Admin\HomeController as AHomeController;
use App\Http\Controllers\Client\HomeController as CHomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

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
Route::get('', [CHomeController::class, 'index']);
Route::get('admin', [AHomeController::class, 'index']);


// Route::group(['middleware' => 'auth'], function (){
//     Route::get('', [HomeController::class, 'index']);

// });

// Auth::routes();

Route::get('/test', [UserController::class, 'index']);