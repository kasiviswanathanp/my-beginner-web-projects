<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LearningController;

Route::post('/learning-path', [LearningController::class, 'learningPath']);
Route::get('/tasks', [LearningController::class, 'tasks']);
Route::post('/chat', [LearningController::class, 'chat']);
Route::get('/progress', [LearningController::class, 'progress']);
