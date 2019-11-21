@extends('layouts.app')

@section('content')
<div class="container">
    <div class="">
        <a href="{{ url('/post') }}" class="btn btn-primary">Back</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card m-3">
                @isset($isEdit)
                <div class="card-header">
                    <h4 class="float-left">Update Post</h4>
                <form action="{{ url('/post/'. $post->id) }}" method="post" class="float-right">
                    @method('DELETE')
                    @csrf
                    <a href="{{ url('/post/create') }}" class="btn btn-primary">Create Post</a>
                    <input type="submit" class="btn btn-danger" value="Delete">
                </form>
                </div>
                @else
                <div class="card-header"><h4>Create New Post</h4></div>
                @endisset

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @isset($isEdit)
                    <form action="{{ url('/post/' . $post->slug) }}" method="post">
                        @method('PUT')
                    <input type="hidden" value="{{ $post->id }}" name="id">
                    @else
                    <form action="{{ route('post.store') }}" method="post">                        
                    @endisset
                        @csrf
                        <div class="row">
                            <div class="col-md-3"><label>Title: </label></div>
                            <div class="col-md-9"><input type="text" name="title" placeholder="Enter Post Title" value="{{ old('title') }}{{ $post->post_name }}" required></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label>Slug: </label></div>
                            <div class="col-md-9">
                                <input type="text" name="slug" placeholder="Enter Post Slug" value="{{ old('slug') }}{{$post->slug }}" @isset($isEdit) disabled="disabled" @endisset required>
                                {{ $errors->post->first('slug') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label>Author Name: </label></div>
                            <div class="col-md-9"><input type="text" name="author_name" placeholder="Enter Post Author Name" value="{{ old('author_name') }}{{ $post->author_name }}" required></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"><label>Content: </label></div>
                            <div class="col-md-9">                                
                                <textarea id="content" name="content">{{ old('content') }}{{ $post->content }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"><input type="submit" name="submit"></div>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-content')
<script>
$(document).ready(function() {
    $('#content').summernote({
        placeholder: 'Enter Post Content',
        tabsize: 2,
        height: 100
      });
});
</script>
@endsection