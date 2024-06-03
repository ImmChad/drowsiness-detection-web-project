<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\Vehicle\VehicleController;
use App\Http\Controllers\Backend\Company\CompanyController;
use App\Http\Controllers\Backend\DashBoard\DashBoardController;
use App\Http\Controllers\Backend\VideoAds\VideoAdsController;
use App\Http\Controllers\Backend\ViewAdsVideo\ViewAdsVideoController;
use App\Http\Middleware\MiddlewareAdmin ;
use Illuminate\Support\Facades\Route;

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


// emulator
Route::get('/emulator-mobile', function () {
    return view('emulatorMobile');
});

Route::group(['prefix' => '/api/view-ads-video'], function () {
    Route::get('/get-exist-video', [ViewAdsVideoController::class, 'getAllVideoWithAppID']);
    Route::post('/human-event', [ViewAdsVideoController::class, 'insertHumanEvent']);
});


Route::get('/', [AdminController::class, 'index']);
Route::get('/login-admin', [AdminController::class, 'renderLoginView']);
Route::post('/login-admin', [AdminController::class, 'loginAdmin']);

Route::get('/logout-admin', [AdminController::class, 'logoutAdmin'])->middleware(MiddlewareAdmin::class);
// admin dashboard
Route::group(['prefix' => '/dashboard', 'middleware' => "middlewareAdmin"], function () {
    Route::get('/', [DashBoardController::class, 'index']);
    Route::post('/get-data-statistics', [DashBoardController::class, 'getDataStatistics']);
});


// admin company
Route::group(['prefix' => '/company', 'middleware' => "middlewareAdmin"], function () {
    Route::get('/all-company', [CompanyController::class, 'showAllCompany']);
    Route::get('/add-company', [CompanyController::class, 'showAddCompany']);
    Route::post('/add-new-company', [CompanyController::class, 'addNewCompany']);
    Route::post('/delete-company', [CompanyController::class, 'deleteCompany']);
    Route::post('/update-new-company', [CompanyController::class, 'updateNewCompany']);
});

// admin user vehicle
Route::group(['prefix' => '/vehicle', 'middleware' => "middlewareAdmin"], function () {
    Route::get('/all-vehicle', [VehicleController::class, 'showAllVehicle']);
        Route::get('/add-vehicle', [VehicleController::class, 'showAddVehicle']);
    Route::post('/add-new-vehicle', [VehicleController::class, 'addVehicle']);

    Route::get('/update-vehicle/{id_car}', [VehicleController::class, 'showUpdateVehicle']);
    Route::post('/update-new-vehicle', [VehicleController::class, 'updateVehicle']);

    Route::get('/delete-vehicle/{id_car}', [VehicleController::class, 'delete
    ']);
    Route::post('/delete-vehicle', [VehicleController::class, 'deleteVehicle']);

    Route::post('/search-vehicle-number', [VehicleController::class, 'searchVehicleByVehicleNumber']);
});

// admin video ads
Route::group(['prefix' => '/video', 'middleware' => "middlewareAdmin"], function () {

    Route::get('/list-company-video/{company_id}',[VideoAdsController::class, 'showListCompanyVideo']);
    Route::get('/list-company-photo/{company_id}',[VideoAdsController::class, 'showListCompanyPhoto']);
    Route::get('/list-company-video',[VideoAdsController::class, 'showListCompanyVideo']);
    Route::get('/list-company-photo',[VideoAdsController::class, 'showListCompanyPhoto']);
    Route::get('/all-video', [VideoAdsController::class, 'showAllVideo']);
    Route::get('/all-image', [VideoAdsController::class, 'showAllImage']);

    Route::get('/add-video', [VideoAdsController::class, 'showAddVideo']);
    Route::post('/add-video-in-media', [VideoAdsController::class, 'addVideoInMedia']);

    Route::post('/update-company-video-image', [VideoAdsController::class, 'updateCompanyVideoImage']);

    Route::post('/add-image-in-media', [VideoAdsController::class, 'addImageInMedia']);
    Route::post('/delete-video-in-media', [VideoAdsController::class, 'deleteVideoInMedia']);
    Route::post('/delete-image-in-media', [VideoAdsController::class, 'deleteImageInMedia']);

    Route::post('/get-all-video-in-media', [VideoAdsController::class, 'getAllVideoAds']);
    Route::post('/get-all-image-in-media', [VideoAdsController::class, 'getAllPhoto']);


});

Route::group(['prefix' => '/about-us', 'middleware' => "middlewareAdmin"], function () {
    Route::get('/',[AdminController::class, 'renderAboutUs']);
});
