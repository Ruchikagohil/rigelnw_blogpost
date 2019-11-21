@extends('layouts.app')

@section('content')
<div class="container">
    <div class="">
        <a href="{{ url('/post') }}" class="btn btn-primary">Back</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
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
                            <div class="col-md-6"><label>Title: </label></div>
                            <div class="col-md-6"><input type="text" name="title" value="{{ $post->post_name }}"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><label>Slug: </label></div>
                            <div class="col-md-6"><input type="text" name="slug" value="{{ $post->slug }}" @isset($isEdit) disabled="disabled" @endisset></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><label>Author Name: </label></div>
                            <div class="col-md-6"><input type="text" name="author_name" value="{{ $post->author_name }}"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><label>Content: </label></div>
                            <div class="col-md-6"><textarea name="content">{{ $post->content }}</textarea></div>
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