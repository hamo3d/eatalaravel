<?php

use App\Http\Controllers\AdvertisementsController;
use App\Http\Controllers\Auth\AdminController;


use App\Http\Controllers\Auth\UsersController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\QuestionAnswerController;
use App\Http\Controllers\SacrificeController;
use App\Http\Controllers\SacrificeFollowupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function () {
Route::post('register', [UsersController::class, 'register']);
Route::post('login', [UsersController::class, 'login']);
});



Route::prefix('auth')->middleware('auth:admin-api')->group(function () {
Route::get('logout', [UsersController::class, 'logout']);

});

Route::middleware('auth:admin-api')->group(function () {
Route::get('indexByUser', [DonationController::class, 'getDonationsByUser']);
Route::get('logout', [UsersController::class, 'logout']);
Route::apiResource("donations", DonationController::class);
Route::apiResource('sacrificeFollowupController',SacrificeFollowupController::class);
Route::get('donationCampaign',[DonationController::class,'getDonationCampaign']);
Route::get('donationZka',[DonationController::class,'getDonationZka']);
Route::get('donationFast',[DonationController::class,'getDonationFast']);
});



Route::apiResource("categories", CategoryController::class);
Route::apiResource("campaigns", CampaignController::class);
Route::apiResource("advertisement",AdvertisementsController::class);
Route::apiResource('sacrifices',SacrificeController::class);
Route::get('/completed-campaigns', [CampaignController::class, 'completedCampaigns']);
Route::resource("questionAndAnswer",QuestionAnswerController::class);




// وين راوت عرض 
Route::get("total",[DonationController::class,'total']);


















