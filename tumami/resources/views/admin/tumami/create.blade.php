@extends('layouts.admin')
@section('title', 'つまみ紹介')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2 class="text-center">新規作成</h2>
            <form action="{{ action('Admin\TumamiController@create') }}" method="post" enctype="multipart/form-data">
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
                        <input type="text" class="form-control" name="tumami_name" value="{{ old('tumami_name') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="introduction">つまみの説明</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="introduction" rows="10">{{ old('introduction') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="tumami_image_path">つまみの画像</label>
                    <div class="col-md-10">
                        <input type="file" class="form-control-file" name="tumami_image_path">
                    </div>
                </div>
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="登録">
            </form>
        </div>
    </div>
</div>
@endsection