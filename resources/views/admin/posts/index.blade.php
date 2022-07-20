{{-- estendo il layout app --}}
@extends('layouts.app')

{{-- scrivo il content --}}
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>All posts</h1>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Title</th>
                        <th scope="col" class="text-center">Slug</th>
                        <th scope="col" class="text-center">Content</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->slug}}</td>
                            <td class="text-truncate" style="max-width: 100px;">{{$post->content}}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                @if ($post->published)
                                    <span class="badge badge-pill badge-success">
                                        Posted
                                    </span>
                                @else
                                    <span class="badge badge-pill badge-secondary">
                                        Unposted
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-primary">Show post</a>
                                <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-warning">Edit post</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center m-4">
        <a href="{{route('admin.posts.create')}}" class="btn btn-success">Create new post</a>
    </div>
</div>
    
@endsection

