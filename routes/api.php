<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
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


Route::prefix('vendor')->group(function () {
    Route::post('/login', [ApiController::class, 'vendorLogin'])->name('login');
    Route::get('/details', [ApiController::class, 'vendorDetail'])->middleware(['auth:api']);
    
});