@extends('layouts.admin')
@section('title', 'プロフィール')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>{{ $profile->nickname }}のプロフィール</h2>
        </div>
    </div>
</div>
@endsection