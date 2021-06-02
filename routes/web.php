<?php

use App\Http\Controllers\DanfeController;
use App\Http\Controllers\MontaController;
use App\Http\Controllers\testeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/',[MontaController::class,'geraNfe']);

Route::get('nfe',[MontaController::class,'nfe']);

Route::get('teste',[testeController::class,'teste']);

Route::get('danfe',[DanfeController::class,'imprimeDanfe']);

