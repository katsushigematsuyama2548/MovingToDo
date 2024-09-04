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
                                        <span class="rounded-md {{ $task->status_class }} px-1 py-0.5 text-white font-medium">{{ $task->status_label }}</span>
                                    </td>
                                    <!-- タスクの期限を表示する -->
                                    <td class="p-2 whitespace-nowrap">{{ $task->formatted_due_date }}</td>
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
</body>
</html>