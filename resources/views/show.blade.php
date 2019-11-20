@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center p-lg-4">show Data</h2>
    <div class="row">
        <div class="col-md-6 text-right">Post Name:</div>
        <div class="col-md-6">{{ $post->post_name }}</div>
    </div>
    <div class="row">
        <div class="col-md-6 text-right">Slug:</div>
        <div class="col-md-6">{{ $post->slug }}</div>
    </div>
    <div class="row">
        <div class="col-md-6 text-right">Author Name:</div>
        <div class="col-md-6">{{ $post->author_name }}</div>
    </div>
    <div class="row">
        <div class="col-md-6 text-right">Content:</div>
        <div class="col-md-6">{{ $post->content }}</div>
    </div>
    <div class="row">
        <div class="col-md-6 text-right">Status:</div>
        <div class="col-md-6">{{ $post->status }}</div>
    </div>
</div>
@endsection