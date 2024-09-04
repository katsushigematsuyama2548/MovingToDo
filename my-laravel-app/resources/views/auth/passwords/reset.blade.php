@extends('layout')
@section('content')
<div class="mx-auto">
    <div class="md:w-2/5 mx-auto">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default bg-white shadow rounded-lg">
                <div class="panel-heading bg-gray-200 p-4 rounded-t-lg">パスワード再発行</div>
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
                    <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}" />
                        <div class="form-group mb-4">
                            <label for="email" class="block text-gray-700">メールアドレス</label>
                            <input type="text" class="text-gray-500 border border-gray-500 text-black rounded py-2 w-full mt-2" id="email" name="email" value="{{ old('email') }}" />
                        </div>
                        <div class="form-group mb-4">
                            <label for="password" class="block text-gray-700">新しいパスワード</label>
                            <input type="password" class="text-gray-500 border border-gray-500 text-black rounded py-2 w-full mt-2" id="password" name="password" />
                        </div>
                        <div class="form-group mb-4">
                            <label for="password-confirm" class="block text-gray-700">新しいパスワード（確認）</label>
                            <input type="password" class="text-gray-500 border border-gray-500 text-black rounded py-2 w-full mt-2" id="password-confirm" name="password_confirmation" />
                        </div>
                        <div class="text-right">
                            <button type="submit" class="text-white bg-sky-400 hover:bg-sky-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mt-4 dark:bg-blue-600 focus:outline-none">送信</button>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection