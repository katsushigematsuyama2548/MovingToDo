@extends('layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">会員登録</div> <!-- 中央揃え -->

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                            <label for="name" class="col-md-4 col-form-label text-md-end">名前</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong> <!-- 変更: $messageを$errors->first('name')に -->
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong> <!-- 変更: $messageを$errors->first('email')に -->
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">パスワード</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong> <!-- 変更: $messageを$errors->first('password')に -->
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">パスワード（確認）</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0 text-end">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary"> <!-- ボタンをブロック要素に -->
                                    送信
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .container {
        margin: 0 auto;
        display: flex; /* 変更: フレックスボックスを使用 */
        justify-content: center; /* 変更: 中央寄せ */
    }
    .row {
        padding: 10px;
        max-width: 600px; /* 変更: 最大幅を600pxに設定 */
        width: 100%; /* 変更: 幅を100%に設定 */
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