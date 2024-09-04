<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\FolderController; // 追加
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;



Route::group(['middleware' => 'auth'], function() {

    Route::get("/folders/{id}/tasks", [TaskController::class,"index"])->name("tasks.index");

    Route::get("/folders/create", [FolderController::class, "showCreateForm"])->name("folders.create");
    Route::post("/folders/create", [FolderController::class, "create"]);

    Route::get("/folders/{id}/tasks/create", [TaskController::class, "showCreateForm"])->name("tasks.create");
    Route::post("/folders/{id}/tasks/create", [TaskController::class, "create"]);

    Route::get("/folders/{id}/edit", [FolderController::class, "showEditForm"])->name("folders.edit");
    Route::post("/folders/{id}/edit", [FolderController::class, "edit"]);

    /* tasks new edit page */
    Route::get('/folders/{id}/tasks/{task_id}/edit', [TaskController::class,"showEditForm"])->name('tasks.edit');
    Route::post('/folders/{id}/tasks/{task_id}/edit', [TaskController::class,"edit"]);

    Route::get('/folders/{id}/delete', [FolderController::class, "showDeleteForm"])->name('folders.delete'); // 修正
    Route::post('/folders/{id}/delete', [FolderController::class,"delete"]);

    Route::get('/folders/{id}/tasks/{task_id}/delete', [TaskController::class,"showDeleteForm"])->name('tasks.delete');
    Route::post('/folders/{id}/tasks/{task_id}/delete', [TaskController::class,"delete"]);
    Auth::routes();

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes(); 