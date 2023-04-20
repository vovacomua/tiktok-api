<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampaignCreateController;

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
    return view('welcome');
});

Route::get('image-upload', [ CampaignCreateController::class, 'imageUpload' ])->name('image.upload');
Route::post('image-upload', [ CampaignCreateController::class, 'imageUploadPost' ])->name('image.upload.post');
