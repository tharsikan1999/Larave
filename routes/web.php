<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    Inertia::render('Dashboard');
    return redirect()->route('students.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
   
    Route::prefix('Students')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('students.index');
        Route::get('/Create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/Store', [StudentController::class, 'store'])->name('students.store');
        Route::get('/{Student}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('/{Student}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/{Students}', [StudentController::class, 'destroy'])->name('students.delete');
    });

});



require __DIR__ . '/auth.php';
