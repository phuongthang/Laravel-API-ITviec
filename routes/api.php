<?php

use App\Http\Controllers\Address\AddressController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Common\ExperienceController;
use App\Http\Controllers\Common\LanguageController;
use App\Http\Controllers\Common\TypeController;
use App\Http\Controllers\Organization\JobController;
use App\Http\Controllers\Organization\OrganizationController;
use App\Http\Controllers\User\CVController;
use App\Http\Controllers\User\UserController;
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

//user
Route::prefix('user')->group(function(){
    Route::get('/profile/{id}',[UserController::class,'edit']);
    Route::post('/profile',[UserController::class,'update']);

    Route::get('/cv/{id}',[CVController::class,'index']);
    Route::post('/cv/create',[CVController::class,'store']);
    Route::post('/cv/update',[CVController::class,'update']);
});


//admin
Route::prefix('admin')->group(function(){
    Route::get('/profile/{id}',[AdminController::class,'edit']);
    Route::post('/profile',[AdminController::class,'update']);
    Route::get('/management/organizations',[ManagementController::class,'listOrganization']);
    Route::get('/management/users',[ManagementController::class,'listUser']);
});

//organization
Route::prefix('organization')->group(function(){
    Route::get('/profile/{id}',[OrganizationController::class,'edit']);
    Route::post('/profile',[OrganizationController::class,'update']);

    Route::post('/job/list',[JobController::class,'index']);
    Route::post('/job/create',[JobController::class,'store']);
    Route::post('/job/edit',[JobController::class,'edit']);
    Route::post('/job/update',[JobController::class,'update']);
    
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



