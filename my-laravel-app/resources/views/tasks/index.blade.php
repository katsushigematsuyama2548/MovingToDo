<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo App</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
<header>
    <nav class="my-navbar flex items-center justify-between bg-gray-800 h-24 mb-12 p-0 px-8">
        <a class="my-navbar-brand text-lg text-gray-400 hover:text-white" href="/">ToDo App</a>
    </nav>
</header>
<main>
    <div class="container mx-auto">
        <div class="flex">
            <div class="w-full md:w-1/3">
                <nav class="panel panel-default bg-white shadow rounded-lg">
                    <div class="panel-heading bg-gray-200 p-4 rounded-t-lg">フォルダ</div>
                    <div class="flex justify-center panel-body p-4">
                        <a href="#" class="btn btn-default btn-block text-gray-500 border border-gray-500 hover:bg-gray-400 text-black rounded py-2 px-9">
                            フォルダを追加する
                        </a>
                    </div>
                    <div class="list-group">
                        <table class="table-auto w-full text-center">
                            @foreach($folders as $folder)
                            <tr class="border-t">
                                <td class="text-left align-middle p-4 hover:text-blue-700 hover:bg-blue-100">
                                    <a href="{{ route('tasks.index', ['id' => $folder->id]) }}" class="list-group-item {{ $folder_id === $folder->id ? 'active' : '' }}">
                                        {{ $folder->title }}
                                    </a>
                                </td>
                                <td class="align-middle p-4"><a href="#" class="text-blue-500 hover:text-blue-700">編集</a></td>
                                <td class="align-middle p-4"><a href="#" class="text-blue-500 hover:text-blue-700">削除</a></td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </nav>
            </div>
            <div class="w-full md:w-2/3">
                <!-- ここにタスクが表示される -->
            </div>
        </div>
    </div>
</main>
</body>
@vite('resources/js/app.js')
</html>