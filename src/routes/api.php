<?php

use App\Http\Controllers\CoursesController;
use Illuminate\Support\Facades\Route;

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

Route::get('/courses', [CoursesController::class, 'index']);
Route::get('/courses/{id}', [CoursesController::class, 'retrieve']);
Route::post('/courses', [CoursesController::class, 'create']);
Route::put('/courses/{id}', [CoursesController::class, 'update']);
Route::delete('/courses/{id}', [CoursesController::class, 'delete']);
