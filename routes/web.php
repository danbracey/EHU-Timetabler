<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/degree', \App\Http\Controllers\DegreeController::class)->middleware('auth');
Route::resource('/student', \App\Http\Controllers\StudentController::class)->middleware('auth');
Route::resource('/module', \App\Http\Controllers\ModuleController::class)->middleware('auth');
Route::resource('/module/{module}/timeslot', \App\Http\Controllers\ModuleTimeslotController::class)
    ->middleware('auth')
    ->except(['index', 'show'])
    ->names('module.timeslot');
Route::resource('/building', \App\Http\Controllers\BuildingController::class)->middleware('auth');
Route::resource('/building/{building}/room', \App\Http\Controllers\RoomController::class)->middleware('auth')->except([
    'index'
]);

Route::get('/generate', [\App\Helpers\TimeslotFunctions::class, 'generateTimetable'])->name('timetable.generate');

require __DIR__ . '/auth.php';
