<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ForgotPasswordController;
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
//USUARIO
Route::post("/register",[AuthController::class,'register']);
Route::post("/login",[AuthController::class,'login']);
Route::post("/logout",[AuthController::class,'logout'])->middleware('auth:api');
Route::post('password/email',[ForgotPasswordController::class,'forgot']);
Route::post('password/reset',[ForgotPasswordController::class,'reset']);
//usuarios 
Route::apiResource('users', UserController::class)->middleware('auth:api');
//blogs
Route::apiResource('blogs', BlogController::class)->middleware('auth:api');
//categorias
Route::apiResource('categories', CategoryController::class)->middleware('auth:api');
//comentarios
Route::apiResource('comments', CommentController::class)->middleware('auth:api');


