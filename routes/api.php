<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ModuleController;

Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);


Route::middleware('auth:sanctum')->group(function () {
 // User modules
    Route::get('/modules', [ModuleController::class, 'userModules']);
    Route::get('/modules/{slug}', [ModuleController::class, 'userModule']);
    // MODULE CRUD
    Route::get('/admin/modules', [ModuleController::class, 'index']);
    Route::post('/admin/modules', [ModuleController::class, 'store']);
    Route::get('/admin/modules/{slug}', [ModuleController::class, 'show']);
    Route::put('/admin/modules/{slug}', [ModuleController::class, 'update']);
    Route::delete('/admin/modules/{slug}', [ModuleController::class, 'destroy']);

    Route::get('profile', [ProfileController::class,'show']);
Route::post('profile', [ProfileController::class,'update']);
});



