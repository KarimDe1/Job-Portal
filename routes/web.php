<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

"Route::get('/', function () {
    return view('welcome');
});";


Route::get('/users', function () {
    return view('user.index');
});



Route::get('/register/Seeker', [UserController::class,'createSeeker'])->name('create.seeker');
Route::post('/register/Seeker', [UserController::class,'storeSeeker'])->name('store.seeker');

Route::get('/register/Employer', [UserController::class,'createEmployer'])->name('create.employer');
Route::post('/register/Employer', [UserController::class,'storeEmployer'])->name('store.employer');



 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::get ('/resend/verification/email', [DashboardController:: class, 'resend' ] )->name('resend.email' ) ;

Route::get('/', [UserController::class,'login'])->name('login');
Route::post('/Login', [UserController::class,'postLogin'])->name('login.post');
Route::get('/login', [UserController:: class,'login' ])->name('login');
Route::post('/logout', [UserController::class,'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class,'index'])->middleware('verified')->name('dashboard');

Route::get('/verify', [DashboardController::class, 'verify' ])->name('verification.notice');
