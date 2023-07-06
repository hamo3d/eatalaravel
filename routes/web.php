<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminWepController;
use App\Http\Controllers\AdvertisementsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BloodRequestController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CampaignWebController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryWebController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\QuestionAnswerController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SacrificeController;
use App\Http\Controllers\SacrificeFollowupController;
use App\Http\Controllers\UserWepController;
use App\Models\BloodRequest;
use App\Models\Hospital;
use App\Models\Reservation;
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

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('cms/admin')->middleware('auth:admin')->group(function() {
Route::get('/home',[HomeController::class,'home'])->name('cms.home');
Route::resource('categories',CategoryController::class);
Route::resource('campaigns',CampaignController::class);
Route::resource('sacrificeFollowupController',SacrificeFollowupController::class);
Route::get('donations',[DonationController::class,'index'])->name('cms.donation.index');
Route::get('donations-zka',[DonationController::class,'getDonationsZka'])->name('cms.donation.zka');
Route::get('donations-general',[DonationController::class,'getDonationFast'])->name('cms.donation.general');
Route::get('donations-sacrifices',[DonationController::class,'getDonationSacrifices'])->name('cms.donation.sacrifices');
Route::get('donations-total',[DonationController::class,'total'])->name('cms.donation.total');


Route::resource('about',AboutController::class);
Route::get('users',[UserWepController::class,'index'])->name('cms.users');
Route::get('admins',[AdminWepController::class,'index'])->name('cms.admins');
Route::get('logout',[AuthController::class,'logout'])->name('cms.logout');
Route::get('edit-password',[AuthController::class,'editPassword'])->name('cms.edit-password');
Route::put('update-password',[AuthController::class,'updatePassword'])->name('cms.update-password');
Route::resource("advertisement",AdvertisementsController::class);
Route::resource("sacrifices",SacrificeController::class);
Route::resource("questionAndAnswer",QuestionAnswerController::class);
Route::resource("blood-request",BloodRequest::class);
Route::resource("reservation",ReservationController::class);
Route::resource("hospital",HospitalController::class);
Route::resource("blood-request",BloodRequestController::class);
});

Route::prefix('cms/admin')->middleware('guest:admin')->group(function() {
Route::get('login' , [AuthController::class,'showLogin'])->name('cms.show-login');
Route::post('login',[AuthController::class,'login'])->name('cms.login');
});


Route::get('payment', [PaypalController::class,'payment']);
Route::get('cansel', [PaypalController::class,'cancel']);
Route::get('payment/success', [PaypalController::class,'success']);



