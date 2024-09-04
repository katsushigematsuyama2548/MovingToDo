<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FolderController; // 追加
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;



Route::group(['middleware' => 'auth'], function() {

    Route::get("/folders/{folder}/tasks", [TaskController::class,"index"])->name("tasks.index");

    Route::get("/folders/create", [FolderController::class, "showCreateForm"])->name("folders.create");
    Route::post("/folders/create", [FolderController::class, "create"]);

    Route::get('/folders/{folder}/tasks/create', [TaskController::class,"showCreateForm"])->name('tasks.create');
    Route::post('/folders/{folder}/tasks/create', [TaskController::class,"create"]);

    Route::get('/folders/{folder}/edit', [FolderController::class,"showEditForm"])->name('folders.edit');
    Route::post('/folders/{folder}/edit', [FolderController::class,"edit"]);

    /* tasks new edit page */
    Route::get('/folders/{folder}/tasks/{task}/edit', [TaskController::class,"showEditForm"])->name('tasks.edit');
    Route::post('/folders/{folder}/tasks/{task}/edit', [TaskController::class,"edit"]);

    Route::get('/folders/{folder}/delete', [FolderController::class,"showDeleteForm"])->name('folders.delete');
    Route::post('/folders/{folder}/delete', [FolderController::class,"delete"]);

    Route::get('/folders/{folder}/tasks/{task}/delete', [TaskController::class,"showDeleteForm"])->name('tasks.delete');
    Route::post('/folders/{folder}/tasks/{task}/delete', [TaskController::class,"delete"]);
    
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes(); 