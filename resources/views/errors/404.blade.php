@extends('layout')
@section('content')
<div class="my-auto">
    <div class="row">
        <div class="col">
            <div class="text-center">
                <h2 style="font-size: 3em;">404 | NOT FOUND</h2> <!-- フォントサイズを変更 -->
                <p style="margin-bottom: 20px;">お探しのページは見つかりませんでした。</p>
                <a href="{{ route('home') }}" class="btn btn-secondary" style="border: 2px solid #6c757d; background-color: #6c757d; padding: 10px 20px; border-radius: 5px; color: white;"> <!-- ボタンスタイルを変更 -->
                    ホームへ戻る
                </a>
            </div>
        </div>
    </div>
</div>
@endsection