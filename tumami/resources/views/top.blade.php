@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @guest
            <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
            @if (Route::has('register'))
            <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
            @else
            <a href="{{ action('Admin\ProfileController@show', ['user_id' => Auth::user()->id]) }}">マイページ</a>
            <a href="{{ action('Admin\TaskController@index', ['user_id' => Auth::user()->id]) }}">タスクを見る</a>
            <a href="{{ action('MapController@index')}}">マップを見る</a>


            @endguest


        </div>
    </div>
</div>
@endsection