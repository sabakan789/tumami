@extends('layouts.admin')
@section('title', 'プロフィールの編集')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>プロフィール編集</h2>
            <form action="{{ action('Admin\ProfileController@update') }}" method="update" enctype="multipart/form-data">
                @if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="form-group row">
                    <label class="col-md-2" for="title">ニックネーム</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="nickname" value="{{ old('nickname') }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="body">自己紹介</label>
                    <div class="col-md-10">
                        <textarea class="form-control" name="profile" rows="10">{{ old('profile') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-2" for="userimage_path">プロフィール画像</label>
                    <div class="col-md-10">
                        <input type="file" class="form-control-file" name="userimage_path">
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
                        <input type="hidden" name="id" value="{{ $profile_form->id }}">
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-primary" value="更新">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection