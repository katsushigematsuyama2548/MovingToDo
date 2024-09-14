@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">ログイン</div> <!-- 中央揃え -->

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">パスワード</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4 text-end"> <!-- 変更: テキストを右寄せ -->
                                <button type="submit" class="btn btn-primary">
                                    ログイン
                                </button>
                            </div>
                        </div>
                    </form>
                    @if (Route::has('password.request'))
                        <div class="mt-3 text-center"> <!-- 変更: マージントップを追加 -->
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                パスワードの変更はこちら
                            </a>
                        </div>
                        <div class="mb-3"> <!-- 変更: 下に空白を追加 -->
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .container {
        margin: 0 auto;
        display: flex; /* フレックスボックスを使用 */
        justify-content: center; /* 中央寄せ */
    }
    .row {
        padding: 10px;
        max-width: 600px; /* 最大幅を600pxに設定 */
        width: 100%; /* 幅を100%に設定 */
    }
    .card {
        border: 1px solid #e0e0e0;
        border-radius: 0.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .card-header {
        background-color: #e2e8f0;
        padding: 1rem;
        font-size: 1.5rem;
    }
    .form-control {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
    }
    .col-md-6 {
        text-align: right;
    }
    .btn-primary {
        background-color: #38bdf8;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
    }
    .btn-block {
        display: block;
        width: 100%;
        margin-right: 10px;
    }
    .invalid-feedback {
        color: #dc3545;
    }
</style>