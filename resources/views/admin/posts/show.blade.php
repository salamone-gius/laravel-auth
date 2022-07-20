{{-- estendo il layout app --}}
@extends('layouts.app')

{{-- scrivo il content --}}
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>{{$post->id}} - {{$post->title}}</h1>
        </div>
        <div class="card-body">
            {{$post->content}}
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center m-4">
        <a href="{{route('admin.posts.index')}}" class="btn btn-secondary">Return to all posts</a>
    </div>
</div>
@endsection
