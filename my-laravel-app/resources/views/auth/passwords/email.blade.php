@extends('layout')

@section('styles')
<!-- Tailwind CSSのスタイルはすでに読み込まれている前提 -->
@endsection

@section('content')
<div class="mx-auto">
    <div class="md:w-2/5 mx-auto">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default bg-white shadow rounded-lg">
                <div class="panel-heading bg-gray-200 p-4 rounded-t-lg">パスワード再発行</div>
                <div class="panel-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                        </div>
                    @endif
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="email" class="block text-gray-700">メールアドレス</label>
                            <input type="text" class="form-control w-full p-2 border border-gray-300 rounded" id="email" name="email" />
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary bg-blue-500 text-white py-2 px-4 rounded">再発行リンクを送る</button>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection