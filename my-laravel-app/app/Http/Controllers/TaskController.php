<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder; // 追加
use App\Models\Task;
use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;


class TaskController extends Controller
{
        /**
     *  【タスク一覧ページの表示機能】
     *
     *  GET /folders/{id}/tasks
     *  @param int $id
     *  @return \Illuminate\View\View
     */

    public function index(int $id)
    {
        $folders =  Folder::all();        
        $folder = Folder::find($id);
        $tasks = $folder->tasks()->get();
        /* DBから取得した情報をViewに渡す */
        // view('遷移先のbladeファイル名', [連想配列：渡したい変数についての情報]);
        // 連想配列：['キー（テンプレート側で参照する際の変数名）' => '渡したい変数']
        return view('tasks/index', [
            'folders' => $folders,
            'folder_id' => $folder->id,
            'tasks' => $tasks,
        ]);        
    }

    public function showCreateForm(int $id)
    {
        /** @var App\Models\User **/
        $user = Auth::user();
        $folder = $user->folders()->findOrFail($id);

        return view('tasks/create', [
            'folder_id' => $folder->id,
        ]);
    }

    public function create(int $id, CreateTask $request)
    {
        /** @var App\Models\User **/
        $user = Auth::user();
        $folder = $user->folders()->findOrFail($id);

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;
        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }

    public function showEditForm(int $id, int $task_id)
    {
        /** @var App\Models\User **/
        $user = Auth::user();
        $folder = $user->folders()->findOrFail($id);

        $task = $folder->find($task_id);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    public function edit(int $id, int $task_id, EditTask $request)
    {
        /** @var App\Models\User **/
        $user = Auth::user();
        $folder = $user->folders()->findOrFail($id);
        $task = $folder->find($task_id);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }

    public function showDeleteForm(int $id, int $task_id)
    {
        /** @var App\Models\User **/
        $user = Auth::user();
        $folder = $user->folders()->findOrFail($id);
        $task = $folder->tasks()->findOrFail($task_id);

        return view('tasks/delete', [
            'task' => $task,
        ]);
    }

    public function delete(int $id, int $task_id)
    {
        /** @var App\Models\User **/
        $user = Auth::user();
        $folder = $user->folders()->findOrFail($id);
        $task = $folder->tasks()->findOrFail($task_id);

        $task->delete();

        return redirect()->route('tasks.index', [
            'id' => $task->folder_id
        ]);
    }
}