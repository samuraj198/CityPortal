<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\ProblemsController::class, 'indexPage'])->name('index');

Route::middleware('auth.custom')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProblemsController::class, 'profilePage'])->name('profile');
});

Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store'])->name('register');
Route::post('/auth', [\App\Http\Controllers\Auth\AuthUserController::class, 'store'])->name('auth');
Route::delete('/logout', [\App\Http\Controllers\Auth\AuthUserController::class, 'destroy'])->name('logout');

Route::post('/createCategory', [\App\Http\Controllers\CategoriesController::class, 'store'])->name('createCategory');
Route::delete('/deleteCategory', [\App\Http\Controllers\CategoriesController::class, 'destroy'])->name('deleteCategory');

Route::post('/createProblem', [\App\Http\Controllers\ProblemsController::class, 'store'])->name('createProblem');
Route::delete('/deleteProblem', [\App\Http\Controllers\ProblemsController::class, 'destroy'])->name('deleteProblem');
Route::post('/changeStatus', [\App\Http\Controllers\ProblemsController::class, 'changeStatus'])->name('changeStatus');
