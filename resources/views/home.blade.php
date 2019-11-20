@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create New Post</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('guest.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6"><label>Title: </label></div>
                            <div class="col-md-6"><input type="text" name="title"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><label>Slug: </label></div>
                            <div class="col-md-6"><input type="text" name="slug"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><label>Author Name: </label></div>
                            <div class="col-md-6"><input type="text" name="author_name"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><label>Content: </label></div>
                            <div class="col-md-6"><textarea name="content"></textarea></div>
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
