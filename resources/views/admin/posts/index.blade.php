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
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Content</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->slug}}</td>
                            <td class="text-truncate" style="max-width: 100px;">{{$post->content}}</td>
                            <td>
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center align-items-center m-4">
                <a href="{{route('admin.posts.create')}}" class="btn btn-secondary">Create new post</a>
            </div>
        </div>
    </div>
</div>
    
@endsection

