@extends('layout')
@section('content')
<div class="mx-auto">
    <div class="md:w-1/2 mx-auto">
    <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default bg-white shadow rounded-lg">
            <div class="panel-heading bg-gray-200 p-4 rounded-t-lg">フォルダを削除する</div>
            <div class="panel-body p-4">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('folders.delete', ['id' => $folder_id]) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="title">フォルダ名</label>
                        <input type="text" class="text-gray-500 border border-gray-500 text-black rounded py-2 w-full mt-2" name="title" id="title" value="{{ old('title') ?? $folder_title }}" disabled />
                    </div>
                    <p class="mt-2">上記の項目を削除しようとしています。本当によろしいでしょうか？</p>
                    <div class="text-right">
                        <button type="button" class="text-white bg-sky-400 hover:bg-sky-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mt-4 dark:bg-blue-600 focus:outline-none" onclick="window.location='{{ route('tasks.index', ['id' => $folder_id]) }}'">キャンセル</button>
                        <button type="submit" class="text-white bg-sky-400 hover:bg-sky-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mt-4 dark:bg-blue-600 focus:outline-none">削除</button>
                    </div>
                </form>
            </div>
        </nav>
    </div>
    </div>
</div>
@endsection