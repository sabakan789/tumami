@extends('layouts.admin')
@section('title', 'タスク管理')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>タスクを作成</h2>
            <form action="{{ action('Admin\TaskController@create')}}" method="POST" enctype="multipart/form-data">
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="form-group row">
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="title" value="{{ old('task') }}">
                    </div>
                </div>
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="タスク追加">
            </form>
        </div>
    </div>
</div>
@if (count($tasks) > 0)
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto index">
            <h2>タスク一覧</h2>
            <div class="row">
                <table class="table table-striped col-md-10">
                    <thead>
                        <tr>
                            <th>タスク</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td>
                                <div>{{ $task->title }}</div>
                            </td>
                            <td class="text-right">
                                <a href="{{ action('Admin\TaskController@delete', ['id' => $task->id]) }}">削除</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif
@endsection