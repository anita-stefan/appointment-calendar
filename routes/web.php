<?php

use App\Http\Controllers\AppointmentController;
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

Route::get('/', [AppointmentController::class, 'appointmentPage']);
Route::get('/appointments', [AppointmentController::class, 'getAppointmentPage']);
Route::get('/hours', [AppointmentController::class, 'getHours']);
Route::post('/insert-data', [AppointmentController::class, 'insertData']);
