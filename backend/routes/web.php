<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
// Route::get('/login', function () {
//     return view('login');
// });
// Route::get('/register', function () {
//     return view('register');
// });





// Route::post('login-user',[AuthController::class,'loginUser'])->name('login-user');
// Route::get('/register',[AuthController::class,'register'])->name('register');
// Route::get('/dashboard', [AuthController::class,'dashboard'])->middleware('isLoggedIn');


