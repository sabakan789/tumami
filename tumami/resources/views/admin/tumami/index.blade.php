@extends('layouts.admin')
@section('title', 'みんなのつまみ')
@section('content')
<div class="container">
    <h2>つまみ一覧</h2>
    <div class="row">
        <div class="col-md-8">
            <form action="{{ action('Admin\TumamiController@index') }}" method="get">
                <div class="form-group row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="tumami_name" value="{{ $tumami_name }}">
                    </div>
                    <div class="col-md-2">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="検索">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <a href="{{ action('Admin\TumamiController@add') }}" role="button" class="btn btn-primary">新規作成</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="row">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th width="30%">つまみの名前</th>
                            <th width="50%">説明</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tumamis as $tumami)
                        <tr>
                            <td>{{ $tumami->tumami_name }}</td>
                            <td>{{ str_limit($tumami->introduction, $limit = 250) }}</td>
                            <td>
                                <div>
                                    <a href="{{ action('Admin\TumamiController@edit', ['id' => $tumami->id]) }}">編集</a>
                                    <a href="{{ action('Admin\TumamiController@delete', ['id' => $tumami->id]) }}">削除</a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection