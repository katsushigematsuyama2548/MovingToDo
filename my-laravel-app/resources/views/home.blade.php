@extends('layout')
@section('content')
<div class="mx-auto">
    <div class="md:w-1/2 mx-auto">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default bg-white shadow rounded-lg">
                <div class="panel-heading bg-gray-200 p-4 rounded-t-lg">
                    まずはフォルダを作成しましょう
                </div>
                <div class="mx-auto p-6">
                    <div class="mx-auto text-center">
                        <a href="{{ route('folders.create') }}" class="text-white bg-sky-400 hover:bg-sky-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mt-4 dark:bg-blue-600 focus:outline-none">
                            フォルダ作成ページへ
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection