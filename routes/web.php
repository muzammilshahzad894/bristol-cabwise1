<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FleetController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserAuthController;
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



Route::get('user/register/show',[UserAuthController::class, 'showRegistrationForm'])->name('user.register.show');
Route::post('user/register',[UserAuthController::class, 'register'])->name('user.register');
Route::get('user/login/form', [UserAuthController::class, 'showLoginForm'])->name('user.login.show');

Route::post('user/login',[UserAuthController::class, 'login'])->name('user.login');
Route::get('user/login/show',[UserAuthController::class, 'logout'])->name('user.logout');

Route::get('payment/success', [BookingController::class, 'success'])->name('payment-success');
Route::get('payment/fail', [BookingController::class,'fail'])->name('payment-fail');

Route::get('/front/quote',[FrontendController::class, 'quote'])->name('frontend.quote');
Route::post('quote',[BookingController::class,'quote'])->name('user.quote');

Route::get('/front/fleets',[FrontendController::class, 'fleets'])->name('frontend.fleets');
Route::get('/front/fleets/detail/{id}',[FrontendController::class, 'fleetsDetails'])->name('frontend.fleets.details');

Route::get('/front/services',[FrontendController::class, 'services'])->name('frontend.services');

Route::get('get-tax/{id}',[FleetController::class,'getTax'])->name('get-tax');

Route::get('/clear', function () {

    return view('test');
});

Route::get('/',[FrontendController::class, 'index'])->name('frontend.welcome');
Route::get('/front/booking',[FrontendController::class, 'booking'])->name('frontend.booking');
Route::get('/admin', function () {
    return view('welcome');
})->name('welcome');

Auth::routes(['verify' => true, 'login' => false, 'register' => false]);

Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

Route::get('/user/signin', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/user/signin', [LoginController::class, 'login']);

Route::get('/user/signup', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/user/signup', [RegisterController::class, 'register']);

Route::group(
    ['prefix' => "/dashboard/", "middleware" => ["auth", 'verified']],
    function () {
        Route::get('', [HomeController::class, 'index'])->name('auth');

        Route::get('my-profile', [UserController::class, 'editprofile'])->name('myprofile');
        Route::put('edit-my-profile', [UserController::class, 'updatemyprofile'])->name('updatemyprofile');

        // change password
        Route::get('/settings', [HomeController::class, 'changePassword'])->name('change_password');
        Route::post('/change-password/update', [HomeController::class, 'updatePassword'])->name('update_password');

        //booking
        Route::Resource('booking',BookingController::class);

        Route::group(
            ["middleware" => "role:admin"],
            function () {
                Route::resource('users', UserController::class)->middleware('isAdmin');
                Route::resource('fleets',FleetController::class);
                Route::get('fleets-gallery/{id}', [FleetController::class, 'gallery'])->name('fleets-gallery');
                Route::get('fleets-destroy/{id}', [FleetController::class, 'destroy'])->name('fleets-destroy');
                Route::get('img-delete/{id}', [FleetController::class, 'deleteImg'])->name('img-delete');
                Route::get('img-edit/{id}', [FleetController::class, 'ImgEdit'])->name('img-edit');
                Route::put('img-update/{id}', [FleetController::class, 'ImgUpdate'])->name('img-update');
            }
        );
    }
);