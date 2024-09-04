@extends('layout')
@section('content')
<div class="my-auto">
    <div class="row">
        <div class="col">
            <div class="text-center">
                <h2 style="font-size: 3em;">500 | SERVER ERROR</h2> <!-- フォントサイズを変更 -->
                <p style="margin-bottom: 20px;">サーバーのエラーが起きました。</p>
                <a href="{{ route('home') }}" class="btn btn-secondary" style="border: 2px solid #6c757d; background-color: #6c757d; padding: 10px 20px; border-radius: 5px; color: white;"> <!-- ボタンスタイルを変更 -->
                    ホームへ戻る
                </a>
            </div>
        </div>
    </div>
</div>
@endsection