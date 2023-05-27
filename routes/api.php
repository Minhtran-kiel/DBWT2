<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

Route::get('/articles',[App\Http\Controllers\ArticleController::class,'index_api'])->name('articles.index_api');
Route::post('/articles', [App\Http\Controllers\ArticleController::class,'store_api'])->name('articles.store_api');
Route::post('/shoppingcart', [App\Http\Controllers\Api\CartController::class,'addToCart_api'])->name('shoppingcart.addToCart_api');
Route::delete('/shoppingcart/{shoppingcartId}/articles/{articleId}',[App\Http\Controllers\Api\CartController::class,'removeFromCart_api'])->name('shoppingcart.removeFromCart_api');