<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Address\AddressController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Common\ExperienceController;
use App\Http\Controllers\Common\LanguageController;
use App\Http\Controllers\Common\TypeController;
use App\Http\Controllers\Organization\JobController;
use App\Http\Controllers\Organization\OfferController;
use App\Http\Controllers\Organization\OrganizationController;
use App\Http\Controllers\User\ApplyController;
use App\Http\Controllers\User\CVController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\UserController;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//login
Route::post('/login',[AccountController::class,'login']);
//user
Route::prefix('user')->group(function(){
    Route::post('/profile/show',[UserController::class,'edit']);
    Route::post('/profile/update',[UserController::class,'update']);

    Route::get('/cv/{id}',[CVController::class,'index']);
    Route::post('/cv/create',[CVController::class,'store']);
    Route::post('/cv/update',[CVController::class,'update']);
    Route::post('/apply/create',[ApplyController::class,'store']);
    Route::post('/review/create',[ReviewController::class,'store']);
    Route::post('/review/show',[ReviewController::class,'show']);
    Route::post('/cv/show',[CVController::class,'show']);
    Route::get('/job/get',[JobController::class,'get']);
    Route::post('/job/query',[JobController::class,'query']);
    Route::get('/organization/get',[OrganizationController::class,'get']);
    Route::post('/apply/confirm',[ApplyController::class,'get']);
    Route::post('/management/offer',[OfferController::class,'index']);
    Route::post('/cv/query',[CVController::class,'query']);

});


//admin
Route::prefix('admin')->group(function(){
    Route::post('/profile/show',[AdminController::class,'edit']);
    Route::post('/profile/update',[AdminController::class,'update']);
    Route::get('/management/organizations',[ManagementController::class,'listOrganization']);
    Route::get('/management/users',[ManagementController::class,'listUser']);
    Route::get('/management/jobs',[ManagementController::class,'listJob']);
    Route::get('/management/cvs',[ManagementController::class,'listCV']);
    Route::post('/organization/delete',[ManagementController::class,'deleteOrganization']);
    Route::post('/user/delete',[ManagementController::class,'deleteUser']);
    Route::post('/job/delete',[ManagementController::class,'deleteJob']);
    Route::post('/job/active',[ManagementController::class,'activeJob']);
    Route::post('/cv/delete',[ManagementController::class,'deleteCV']);
    Route::post('/cv/active',[ManagementController::class,'activeCV']);
    Route::post('/job/status',[ManagementController::class,'activeStatusJob']);
    Route::post('/organization/active',[ManagementController::class,'activeOrganization']);
    Route::get('/cv/get',[CVController::class,'get']);
    
});

//organization
Route::prefix('organization')->group(function(){
    Route::post('/profile/show',[OrganizationController::class,'edit']);
    Route::post('/profile/update',[OrganizationController::class,'update']);

    Route::post('/job/list',[JobController::class,'index']);
    Route::post('/job/create',[JobController::class,'store']);
    Route::post('/job/edit',[JobController::class,'edit']);
    Route::post('/job/update',[JobController::class,'update']);
    Route::post('/job/detail',[JobController::class,'show']);
    Route::post('/apply/show',[ApplyController::class,'show']);
    Route::post('/apply/status',[ApplyController::class,'update']);
    Route::post('/offer/create',[OfferController::class,'store']);
    
});

//address
Route::prefix('address')->group(function(){
    Route::get('/province',[AddressController::class,'province']);
    Route::get('/district/{_province_id}',[AddressController::class,'district']);
    Route::get('/ward/{_district_id}',[AddressController::class,'ward']);
});

//common
Route::prefix('common')->group(function(){
    Route::get('/languages',[LanguageController::class,'index']);
    Route::get('/types',[TypeController::class,'index']);
    Route::get('/experiences',[ExperienceController::class,'index']);
});



