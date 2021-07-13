<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BackController;
use App\Http\Controllers\ItemsController;
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

Route::get('/',function(){
    return view('lobby.index');
});
//首頁路由
// Route::get('/login',[LoginController::class,'index'])->name('login');
//
Route::group(['middleware' => 'identity'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
Route::group(['prefix' => 'login'], function () {
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::post('/logout', [LoginController::class, 'destroy']);
});
Route::group(['prefix' => 'front','middleware' => 'identity'], function () {
    Route::get('/', [ReviewController::class, 'index'])->name('front');
    Route::post('/getGroup', [ReviewController::class, 'getGroup']);
    

});
Route::group(['prefix' => 'back','middleware' => 'identity'], function () {
    Route::get('/', [BackController::class, 'index'])->name('back');
    Route::get('/setting', [BackController::class, 'setView']);
    Route::post('/setGroup', [BackController::class, 'setGroup']);
    Route::post('/getGroup', [BackController::class, 'getGroup']);
    Route::get('/getAllUser', [BackController::class, 'getAllUser']);
    Route::post('/updatePermission', [BackController::class, 'updatePermission']);
    Route::post('/appendChair', [BackController::class, 'appendChair']);
    Route::post('/deleteChair', [BackController::class, 'deleteChair']);
    Route::post('/uploadCSV', [BackController::class, 'uploadCSV']);
});
Route::group(['prefix' => 'items','middleware' => 'identity'], function () {
    Route::get('groupItem/{id}', [ItemsController::class, 'getItemOfGroup']);
    Route::get('allItems/{id}', [ItemsController::class, 'getAllItems']);
    Route::get('scoreDone/{id}', [ItemsController::class, 'getItemOfDone']);
    Route::get('scoreUnDone/{id}', [ItemsController::class, 'getItemOfUnDone']);
    Route::get('photoItem/{id}', [ItemsController::class, 'getItemOfPhoto']);
    Route::post('scoreSheet', [ItemsController::class, 'scoreSheet']);
});