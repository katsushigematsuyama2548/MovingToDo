<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Folder;
use App\Models\Task;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = auth()->user();
            $folders = $user->folders()->get();
            $folder = $folders->first(); // 最初のフォルダーを取得
            $tasks = $folder ? $folder->tasks()->get() : collect(); // フォルダーが存在する場合のみタスクを取得
    
            if (is_null($folder)) {
                return view('home');
            }
    
            return redirect()->route('tasks.index', [
                'folder' => $folder->id,
            ]);
        } else {
            $folders = Folder::whereNull('user_id')->get();
            $tasks = Task::whereHas('folder', function ($query) {
                $query->whereNull('user_id');
            })->get();
    
            return view('tasks.index', [
                'folders' => $folders,
                'tasks' => $tasks,
                'folder' => $folders->first(),
                'folder_id' => $folders->first() ? $folders->first()->id : null,
            ]);
        }   
    }
}