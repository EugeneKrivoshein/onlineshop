<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware'=>'api', 'prefix'=>'auth'], function($router) {
    Route::post('/register', [AuthController::class, 'register']); 
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/refresh', [AuthController::class, 'refresh']); 
    Route::get('/profile', [AuthController::class, 'profile']); 
    Route::post('/logout', [AuthController::class, 'logout']);
    
});


Route::post('/category', [CategoryController::class, 'store']);
Route::get('/categories', [CategoryController::class, 'getAllCategories']);


Route::post('/product', [ProductController::class, 'store']);
Route::get('/product/{slug}', [ProductController::class, 'getBySlug']);
Route::get('/products', [ProductController::class, 'index']);


Route::post('/cart', [CartController::class, 'add']); 
Route::put('/cart/{id}', [CartController::class, 'update']);
Route::delete('/cart/{id}', [CartController::class, 'delete']);

Route::post('/order', [OrderController::class, 'store']);
Route::get('/orders', [OrderController::class, 'show']);