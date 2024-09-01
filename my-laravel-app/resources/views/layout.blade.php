<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ToDo App</title>
    @yield('styles')
    @vite('resources/css/app.css')
</head>
<body>
    <header>
        <nav class="my-navbar flex items-center justify-between bg-gray-800 h-24 mb-12 p-0 px-8">
            <a class="my-navbar-brand text-lg text-gray-400 hover:text-white" href="#">ToDo App</a>
            <div class="my-navbar-control">
            @if(Auth::check())
                <span class="my-navbar-item text-gray-400 hover:text-white">ようこそ, {{ Auth::user()->name }}さん</span>
                ｜
                <a href="#" id="logout" class="my-navbar-item text-gray-400 hover:text-white">ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a class="my-navbar-item text-gray-400 hover:text-white" href="{{ route('login') }}">ログイン</a>
                ｜
                <a class="my-navbar-item text-gray-400 hover:text-white" href="{{ route('register') }}">会員登録</a>
            @endif
        </div>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    @if(Auth::check())
    <script>
        document.getElementById('logout').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    });
    </script>
@endif
    @yield('scripts')
</body>
</html>