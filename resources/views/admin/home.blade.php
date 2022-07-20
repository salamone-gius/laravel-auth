@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center m-4">
                <a href="{{route('admin.posts.index')}}" class="btn btn-secondary">See all posts</a>
            </div>
            <div class="d-flex justify-content-center align-items-center m-4">
                <a href="{{route('admin.posts.create')}}" class="btn btn-secondary">Create new post</a>
            </div>
        </div>
    </div>
</div>
@endsection
