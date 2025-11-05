<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\ModuleSectionController;
use App\Http\Controllers\Admin\ModuleSectionQuestionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionProgressController;

Route::middleware('auth:sanctum')->group(function () {
    
    Route::get('/sections/{sectionId}', [SectionProgressController::class, 'show']);
    Route::get('/modules/{moduleId}/sections-progress', [SectionProgressController::class, 'index']);
    Route::post('/sections/{sectionId}/submit', [SectionProgressController::class, 'submit']);

    Route::get('/profile', [ProfileController::class, 'show']);
});

Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::middleware('auth:sanctum')->prefix('admin')->group(function () {

    // Module CRUD
    Route::get('/modules/index', [ModuleController::class, 'index']);
    Route::post('/modules/store', [ModuleController::class, 'store']);
    Route::get('/modules/{slug}/show', [ModuleController::class, 'show']);
    Route::put('/modules/{slug}/update', [ModuleController::class, 'update']);
    Route::delete('/modules/{slug}/delete', [ModuleController::class, 'destroy']);

    // Section CRUD
    Route::post('/sections/{slug}/store', [ModuleSectionController::class, 'store']);
    Route::get('/sections/{sectionId}/show', [ModuleSectionController::class, 'show']);
    Route::put('/sections/{sectionId}/update', [ModuleSectionController::class, 'update']);
    Route::delete('/sections/{sectionId}/delete', [ModuleSectionController::class, 'destroy']);

    // Question CRUD
    Route::get('/questions/{sectionId}/index', [ModuleSectionQuestionController::class, 'index']);
    Route::post('/questions/{sectionId}/store', [ModuleSectionQuestionController::class, 'store']);
    Route::get('/questions/{questionId}/show', [ModuleSectionQuestionController::class, 'show']);
    Route::put('/questions/{questionId}/update', [ModuleSectionQuestionController::class, 'update']);
    Route::delete('/questions/{questionId}/delete', [ModuleSectionQuestionController::class, 'destroy']);
});
