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
                            <td style="min-width: 350px;">
                                <a href="{{route('admin.posts.show', $post->id)}}" class="btn btn-primary">Show post</a>
                                <a href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-warning">Edit post</a>
                                <form class="d-inline-block" action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" href="{{route('admin.posts.edit', $post->id)}}" class="btn btn-danger">Delete post</button>
                                </form>
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

