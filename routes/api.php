<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// AUTH ROUTES
Route::get('/register', 'AuthController@register');
//Route::get('/login', 'AuthController@login');
Route::get('/verify-email', 'AuthController@verifyEmail');
Route::post('/tokens/create', 'AuthController@createToken');