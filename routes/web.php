<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\SubtaskController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::get('projects-data', [ProjectController::class, 'getProjects'])->name('projects.data');
    Route::resource('projects.tasks', TaskController::class);
    Route::get('projects/{project}/tasks-data', [TaskController::class, 'getTasks'])->name('tasks.data');    
    Route::resource('projects.tasks.subtasks', SubtaskController::class);
    Route::get('projects/{project}/tasks/{task}/subtasks-data', [SubtaskController::class, 'getSubtasks'])->name('subtasks.data');
    Route::get('/reports/form/{projectId}', [ProjectController::class, 'showReportForm'])->name('report.form');
    Route::get('/reports/generate/{projectId}', [ProjectController::class, 'generateAndDisplayReport'])->name('report.generate');});

require __DIR__.'/auth.php';
