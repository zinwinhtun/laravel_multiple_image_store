<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', function () {
    return to_route('image-upload');
});

Route::controller(PostController::class)->group(function(){
    Route::get('image-upload','index')->name('image-upload');
    Route::post('image-upload','store')->name('image.store');
    Route::delete('image/{id}','destroy')->name('image.destroy');
});
