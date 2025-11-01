<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\TreeController;


Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);


Route::middleware('auth:sanctum')->group(function(){
Route::post('auth/logout', [AuthController::class,'logout']);
Route::get('profile', [ProfileController::class,'show']);
Route::post('profile', [ProfileController::class,'update']);
Route::get('modules', [ModuleController::class,'index']);
Route::get('modules/{slug}', [ModuleController::class,'show']);
Route::get('lessons/{id}', [LessonController::class,'show']);
Route::post('lessons/{id}/complete', [LessonController::class,'complete']);
Route::get('quiz/{id}/start', [QuizController::class,'start']);
Route::post('quiz/{id}/submit', [QuizController::class,'submit']);
Route::get('progress', [ProgressController::class,'index']);
Route::get('achievements', [AchievementController::class,'list']);
Route::post('achievements/{id}/claim', [AchievementController::class,'claim']);
Route::get('tree', [TreeController::class,'stats']);
});