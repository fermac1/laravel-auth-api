<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;

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

Route::post('/user/create',[UserController::class,'register']);
// //API route for login user
Route::post('/user/login', [UserController::class, 'login']);

Route::put('/user/update/{id}',[UserController::class,'update']);

Route::delete('/user/delete/{id}',[UserController::class,'delete']);

Route::get('/user',[UserController::class,'getUser']);

Route::get('/users',[UserController::class,'getUsers']);
