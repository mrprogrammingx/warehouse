<?php

use App\Http\Controllers\Api\FileController;
use App\Http\Livewire\FileDownload;
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

//Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('login');
Route::get('livewire-file-upload', function () {
    return view('livewire.welcome');
});

Route::get('file-download',[FileController::class,'download'])->name('file-download');
Route::get('file-show',[FileController::class,'show'])->name('file-show');
