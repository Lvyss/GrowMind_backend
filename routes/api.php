<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModuleFillChallengeController;



Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);


Route::middleware('auth:sanctum')->group(function () {
 // User modules
    Route::get('/modules', [ModuleController::class, 'userModules']);
    Route::get('/modules/{slug}', [ModuleController::class, 'userModule']);

    // ADMIN CRUD
    Route::get('/admin/modules', [ModuleController::class, 'index']);
    Route::post('/admin/modules', [ModuleController::class, 'store']);
    Route::get('/admin/modules/{slug}', [ModuleController::class, 'show']);
    Route::put('/admin/modules/{slug}', [ModuleController::class, 'update']);
    Route::delete('/admin/modules/{slug}', [ModuleController::class, 'destroy']);

// ADMIN CHALLENGES PER MODULE
Route::get('/admin/modules/{module}/challenges', [ModuleFillChallengeController::class, 'index']);
Route::post('/admin/modules/{module}/challenges', [ModuleFillChallengeController::class, 'store']);
Route::get('/admin/modules/{module}/challenges/{challenge}', [ModuleFillChallengeController::class, 'show']);
Route::put('/admin/modules/{module}/challenges/{challenge}', [ModuleFillChallengeController::class, 'update']);
Route::delete('/admin/modules/{module}/challenges/{challenge}', [ModuleFillChallengeController::class, 'destroy']);



    Route::get('profile', [ProfileController::class,'show']);
Route::post('profile', [ProfileController::class,'update']);
});



