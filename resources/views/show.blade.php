@extends('layouts.app')

<style>
.content {
    max-width: 70%;
    margin: 0 auto;
    background: white;
    border: 1px solid #ccc;
}
.content .row {
    margin: 0px;    
    padding: 10px;
    border: 1px solid #ccc;
    margin-right: -1px;
    margin-left: -1px;
    margin-bottom: -1px;
}
</style>
@section('content')
<div class="container">
    <div class="">
        <a href="{{ url('/post') }}" class="btn btn-primary">Back</a>
        <a href="{{ url('/post/create') }}" class="btn btn-primary float-right">Create Post</a>
    </div>
    <div class="content">
        <h2 class="text-center p-lg-4">Show Post Data</h2>
        <div class="row">
            <div class="col-md-3">Post Name:</div>
            <div class="col-md-9">{{ $post->post_name }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Slug:</div>
            <div class="col-md-9">{{ $post->slug }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Author Name:</div>
            <div class="col-md-9">{{ $post->author_name }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Content:</div>
            <div class="col-md-9">{{ $post->content }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Status:</div>
            <div class="col-md-9">{{ $post->status }}</div>
        </div>
    </div>
</div>
@endsection