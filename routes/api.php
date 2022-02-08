<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WorkflowsController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\StatusesController;


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


Route::resource('workflows', WorkflowsController::class);



Route::get('statuses/{id}', [StatusesController::class, 'index']);
Route::put('statuses/{id}', [StatusesController::class, 'update']);

Route::get('images/{id}', [ImagesController::class, 'index']);
Route::post('images/{id}', [ImagesController::class, 'store']);
Route::put('images/{id}', [ImagesController::class, 'update']);
Route::delete('images/{id}', [ImagesController::class, 'destroy']);






//Route::resource('images', ImagesController::class);

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/