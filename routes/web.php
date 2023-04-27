<?php

use App\Http\Controllers\hello;
use App\Http\Controllers\PageController;
use App\Http\Controllers\studentcontroller;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes định hướng đường dẫn
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/add', function () {
    return view('add');
});

Route::get('/welcome', function(){
    return 'Chào mừng các bạn đã đến với PNV';
});
Route::get('/',[App\Http\Controllers\hello::class,'xinchao']);
Route::get('/',[App\Http\Controllers\studentcontroller::class,'getStudent']);

Route::get('sum', [App\Http\Controllers\SumController::class, 'index']);
Route::post('sum', [App\Http\Controllers\SumController::class, 'Summ']);

Route::get('AreaOfShape', [App\Http\Controllers\AreaController::class, 'index']);
Route::post('AreaOfShape', [App\Http\Controllers\AreaController::class, 'Area']);
Route::get('covid',[App\Http\Controllers\covid::class,'index']);

Route::get('form',[App\Http\Controllers\singupController::class,'index']);
Route::post('form',[App\Http\Controllers\singupController::class,'displayInfor']);


Route::get('master', [PageController::class, 'index']);