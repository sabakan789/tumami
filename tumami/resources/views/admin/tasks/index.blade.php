@extends('layouts.admin')
@section('title', 'タスク管理')

@section('content')
<div class="container">
    <div class="col-sm-offset-2 col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                新しいタスク
            </div>

            <div class="panel-body">

                <!-- 新タスクフォーム -->
                <form action="{{ action('Admin\TaskController@create')}}" method="POST" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                    @endif

                    <!-- タスク名 -->
                    <div class="form-group">
                        <label for="task-name" class="col-sm-3 control-label">タスク</label>

                        <div class="col-sm-6">
                            <input type="text" name="title" class="form-control" value="{{ old('task') }}">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <!-- タスク追加ボタン -->
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-default">
                                <i class="fa fa-btn fa-plus"></i> タスク追加
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                現在のタスク
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <tr>
                            <th>タスク</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($tasks as $task)
                        <tr>
                            <td class="table-text">
                                <div>{{ $task->title }}</div>
                            </td>
                            <td>
                                <!-- <form action="{{ action('Admin\TaskController@delete') }}" method="delete">

                                    {{ csrf_field() }}
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i> 削除
                                    </button>
                                </form> -->
                                <a href="{{ action('Admin\TaskController@delete', ['id' => $task->id]) }}">削除</a>
                            </td>
                            <td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection