<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\PassportAuthController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\EmployeeResource;
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
Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('companies', CompanyController::class);
});

Route::middleware('auth:sanctum')->group( function () {
   Route::resource('employee', EmployeeController::class);
});


 
 

 