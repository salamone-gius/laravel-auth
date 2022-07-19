@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Crea un nuovo post</h1>
        </div>
        <div class="card-body">
            <form action="{{route('admin.posts.index')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                {{-- si potrebbe aggiungere la WYSIWYG ckeditor (textarea con possibilità di personalizzare il testo), ma poi i dati che ritornerebbero sarebbero troppo complessi da gestire (per il momento)  --}}
                {{-- <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="ckeditor form-control" id="content" name="content"></textarea>
                </div> --}}
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" id="content" name="content" rows="6"></textarea>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="published" name="published">
                    <label class="form-check-label" for="published">Post</label>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
    
@endsection

{{-- aggiungo lo script per istanziare la WYSIWYG ckeditor (textarea con possibilità di personalizzare il testo) --}}
{{-- <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script> --}}