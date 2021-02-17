<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
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

Route::get('/',[PagesController::class,'home']);
Route::get('/faq',[PagesController::class,'faq']);
Route::get('/namedays',[PagesController::class,'namedays']);
Route::get('search' ,[\App\Http\Controllers\SearchController::class,'search']);
Route::get('/{id}', [\App\Http\Controllers\PagesController::class,'show']);
