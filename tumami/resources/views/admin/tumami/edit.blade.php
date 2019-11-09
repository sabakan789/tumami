@extends('layouts.admin')
@section('title', 'つまみ編集')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2 class="text-center">編集</h2>
            <form action="{{ action('Admin\TumamiController@update') }}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="form-group row">
                    <label class="col-md-2" for="tumami_name">つまみの名前</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="tumami_name" value=" {{ $tumami_form->tumami_name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="introduction">つまみの説明</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="introduction" rows="10">{{ $tumami_form->introduction }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="tumami_image_path">つまみの画像</label>
                    <div class="col-md-10">
                        <input type="file" class="form-control-file" name="tumami_image_path">
                        <div class="form-text text-info">
                            設定中: {{ $tumami_form->tumami_image_path }}
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-10">
                        <input type="hidden" name="id" value="{{ $tumami_form->id }}">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="更新">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection