@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @guest
            <div class="col-md-offset-4 col-md-4">
                <a href="{{ route('login') }}">ログイン</a>
            </div>
            @if (Route::has('register'))
            <div class="col-md-offset-4 col-md-4">
                <a href="{{route('register')}}">新規登録</a>
            </div>
            @endif
            @else

            <!-- <div class="col-md-offset-4 col-md-4">
                <a href="{{ action('Admin\ProfileController@show', ['user_id' => Auth::user()->id]) }}">マイページ</a>
            </div> -->
            <div class="col-md-offset-4 col-md-4">
                <a href="{{ action('Admin\TaskController@index', ['user_id' => Auth::user()->id]) }}">タスクを見る</a>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <a href="{{ action('MapController@index')}}">マップを見る</a>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <a href="{{ action('Admin\TumamiController@add')}}">投稿をする</a>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <a href="{{ action('Admin\TumamiController@index')}}">投稿一覧</a>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <a href="{{ action('MapController@index')}}">みんなの投稿</a>
            </div>
            @endguest
        </div>
    </div>
</div>
@endsection