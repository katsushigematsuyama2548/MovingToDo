@extends('layout')
@section('styles')
    <!-- 「flatpickr」の デフォルトスタイルシートをインポート -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- 「flatpickr」の ブルーテーマの追加スタイルシートをインポート -->
    <link rel="stylesheet" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="flex">
            <div class="w-full md:w-1/3">
                <nav class="panel panel-default bg-white shadow rounded-lg">
                    <div class="panel-heading bg-gray-200 p-4 rounded-t-lg">フォルダ</div>
                    <div class="flex justify-center panel-body p-4">
                        <a href="{{route('folders.create')}}" class="btn btn-default btn-block flex justify-center text-gray-500 border border-gray-500 hover:bg-gray-400 text-black rounded py-2 w-full">
                            フォルダを追加する
                        </a>
                    </div>
                    <div class="list-group">
                        <table class="table-auto w-full text-center">
                            @foreach($folders as $folder)
                            @if($folder->user_id === Auth::user()->id)
                                    <tr class="border-t border-gray-200">
                                        <td class="pt-3 pb-3 text-left pl-5">
                                            <a href="{{ route('tasks.index', ['folder' => $folder->id]) }}" class="list-group-item {{ $folder_id === $folder->id ? 'active' : '' }}">
                                                {{ $folder->title }}
                                        </a>
                                        </td>
                                        <td class="text-right pl-20"><a href="{{ route('folders.edit', ['folder' => $folder->id]) }}" class="text-blue-500 hover:text-blue-700 justify-end flex items-end">編集</a></td>
                                        <td class="text-right pr-5"><a href="{{ route('folders.delete', ['folder' => $folder->id]) }}" class="text-blue-500 hover:text-blue-700">削除</a></td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </nav>
            </div>
            <div class="w-full md:w-2/3 pl-8">
                <!-- ここにタスクが表示される -->
                <div class="bg-white">
                    <div class="panel-heading bg-gray-200 p-4 rounded-t-lg">タスク</div>
                    <div>
                        <div class="flex justify-center panel-body p-4">
                            <a href="{{ route('tasks.create', ['folder' => $folder_id]) }}" class="btn btn-default btn-block  flex justify-center text-gray-500 border border-gray-500 hover:bg-gray-400 text-black rounded py-2 w-full">
                                タスクを追加する
                            </a>
                        </div>
                    </div>
                    <table class="w-full bg-white border rounded-md">
                        <thead>
                            <tr class="">
                                <th class="text-left p-2">タイトル</th>
                                <th class="text-left p-2">状態</th>
                                <th class="text-left p-2">期限</th>
                                <th class="text-left p-2"></th>
                                <th class="text-left p-2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--
                            * 【task一覧セクション】
                            * foreach の中でTaskControllerから渡されたデータ $tasks を参照する
                            * $tasks をループして値をて表示する
                            -->
                            @foreach($tasks as $task)
                                <tr class="border-t">
                                    <!-- タスクのタイトルを表示する -->
                                    <td class="p-2">{{ $task->title }}</td>


                                    <!-- タスクの状態を表示する -->
                                    <td class="p-2">
                                        <select class="status-select custom-status-select rounded-md {{ $task->status_class }} px-1 py-0.5 text-white font-medium" data-task-id="{{ $task->id }}">
                                            @foreach(\App\Models\Task::STATUS as $key => $val)
                                                <option value="{{ $key }}" {{ $key == $task->status ? 'selected' : '' }}>
                                                    {{ $val['label'] }}
                                                </option>                                            
                                            @endforeach
                                        </select>
                                    </td>
                                    <!-- タスクの期限を表示する -->
                                    <td class="p-2 whitespace-nowrap">
                                        <input type="text" class="due-date-input" data-task-id="{{ $task->id }}" value="{{ $task->formatted_due_date }}" id = "due_date">
                                    </td>
                                    <!-- 編集と削除のリンクを表示する -->
                                    <td class="p-2 text-blue-500 hover:text-blue-700"><a href="{{ route('tasks.edit', ['folder' => $task->folder_id, 'task' => $task->id]) }}">編集</a></td>
                                    <td class="p-2 text-blue-500 hover:text-blue-700">
                                        <a href="{{ route('tasks.delete', ['folder' => $task->folder_id, 'task' => $task->id]) }}">削除</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('share.flatpickr.scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOMContentLoaded event fired'); // デバッグ用ログ

            const statusSelects = document.querySelectorAll('.custom-status-select');
            const dueDateInputs = document.querySelectorAll('.due-date-input'); // クラスセレクタに変更

            statusSelects.forEach(select => {
                select.addEventListener('change', function () {
                    const taskId = this.dataset.taskId;
                    const status = this.value;

                    fetch(`/tasks/${taskId}/update-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ status })
                    }).then(response => response.json())
                      .then(data => {
                          if (data.success) {
                              alert('状態が更新されました');
                          } else {
                              alert('更新に失敗しました');
                          }
                      });
                });
            });

            dueDateInputs.forEach(input => {
                const taskId = input.dataset.taskId;
                const uniqueId = `due_date_${taskId}`; // 一意のIDを生成
                input.id = uniqueId; // IDを設定

                console.log('Initializing flatpickr for:', input); // デバッグ用ログ
                flatpickr(input, { // クラスセレクタに変更
                    locale: 'ja',
                    dateFormat: "Y/m/d",
                    minDate: new Date(),
                    onChange: function(selectedDates, dateStr, instance) {
                        fetch(`/tasks/${taskId}/update-due-date`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ due_date: dateStr })
                        }).then(response => response.json())
                          .then(data => {
                              if (data.success) {
                                  alert('期限が更新されました');
                              } else {
                                  alert('更新に失敗しました');
                              }
                          });
                    }
                });
            });
        });
    </script>
@endsection