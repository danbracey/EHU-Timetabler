<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\GetStudentDetails;

Route::get('/', GetStudentDetails::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/degree', \App\Http\Controllers\DegreeController::class)->middleware('auth');
Route::resource('/student', \App\Http\Controllers\StudentController::class)->middleware('auth');

require __DIR__ . '/auth.php';
