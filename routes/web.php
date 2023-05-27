<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
Route::get('/isloggedin', [App\Http\Controllers\AuthController::class, 'isloggedin'])->name('haslogin');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/articles',[App\Http\Controllers\ArticleController::class,'index'])->name('articles.index');
Route::post('/articles', [\App\Http\Controllers\ArticleController::class, 'store'])->name('articles.store');
Route::get('/kategorien', [App\Http\Controllers\ArticleController::class, 'kategorien'])->name('kategorien');
Route::get('verkaufen', [\App\Http\Controllers\ArticleController::class, 'verkaufen'])->name('verkaufen');
Route::get('/newarticle', function(){return view('newarticle');});

Route::get('/test', function(){return view('test');});

Route::get('/menu', [App\Http\Controllers\Controller::class, 'show_menu'])->name('menu');
Route::get('/career', [App\Http\Controllers\Controller::class, 'show_career'])->name('career');
Route::get('/philosophie', [App\Http\Controllers\Controller::class, 'show_philosophie'])->name('philosophie');

Route::get('/cookiecheck', function(){return view('cookiecheck');});
