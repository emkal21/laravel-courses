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

Route::get('/courses', [CoursesController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CoursesController::class, 'retrieve'])->name('courses.retrieve');
Route::post('/courses', [CoursesController::class, 'create'])->name('courses.create');
Route::put('/courses/{id}', [CoursesController::class, 'update'])->name('courses.update');
Route::delete('/courses/{id}', [CoursesController::class, 'delete'])->name('courses.delete');
