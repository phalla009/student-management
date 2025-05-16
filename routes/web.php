<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
// Default route to show a view (layout)
Route::get('/', function () {
    return view('layout');
});

// Resource routes
Route::resource('/students', StudentController::class);
Route::resource('/teachers', TeacherController::class);
Route::resource('/courses', controller: CoursesController::class);
Route::resource('/batches', controller: BatchController::class);
Route::resource('/enrollments', controller: EnrollmentController::class);
Route::resource('/payments', controller: PaymentController::class);
Route::get('/report/report1/{pid}', [App\Http\Controllers\ReportController::class, 'report1']);


