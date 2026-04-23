<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

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

Route::middleware('auth')->group(function () {
    Route::get('/attendance', [AttendanceController::class, 'attendance']);

    Route::post('/attendance/start', [AttendanceController::class, 'workStart'])->name('work.start');

    Route::patch('/attendance/end', [AttendanceController::class, 'workEnd'])->name('work.end');

    Route::post('/break/start', [AttendanceController::class, 'breakStart'])->name('break.start');

    Route::patch('/break/end', [AttendanceController::class, 'breakEnd'])->name('break.end');

    Route::get('/attendance/list', [AttendanceController::class, 'index'])->name('attendance.index');

    Route::get('/attendance/detail/{attendanceId}', [AttendanceController::class, 'show'])->name('attendance.show');

    Route::post('/attendance/detail/store/{attendanceId}', [AttendanceController::class, 'requestStore'])->name('attendance.request');

    Route::get('/stamp_correction_request/list',[AttendanceController::class, 'requestList'])->name('request.list');
});
