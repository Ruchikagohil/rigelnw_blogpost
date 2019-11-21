@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center p-2 float-left">Posts List</h2>
    <a href="{{ url('/post/create') }}" class="btn btn-primary float-right">Create Post</a>
    <table class="table table-hover" width="100%">
        <thead>
            <tr>
                <th>Post Name</th>
                <th>Slug</th>
                <th>Author Name</th>
                <th>Content</th>
                <th>Status</th>
                @adminUser
                <th>Created By</th>
                <th>Action</th>
                @endadminUser
            </tr>
        </thead>
        <tbody> 
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->post_name }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->author_name }}</td>
                    <td>{!!html_entity_decode($post->content)!!}</td>
                <td id="chng_status-{{ $post->id }}">{{ $post->status}}</td>
                    @adminUser
                    <td>{{ $post->created_by}}</td>
                    <td>
                    <a href="{{ url('/post/'. $post->slug) }}" class="btn btn-success">Show</a>
                    <a href="{{ url('/post/'. $post->slug .'/edit') }}" class="btn btn-info">Edit</a>
                    <button class="btn btn-success" id="status-{{ $post->id }}" onclick="setStatus({{ $post->id }})">
                        @if($post->status == 'Draft') Publish
                        @else Draft
                        @endif
                    </button>
                    </td>
                    @else
                    <td>
                       <a href="{{ url('/post/'. $post->slug) }}" class="btn btn-success">Show</a>
                    </a>
                    @endadminUser
                </tr>                
            @endforeach   
        </tbody>
    </table>
</div>
@endsection

@section('script-content')
<script>
function setStatus(id) {
    window.axios.patch(`/api/post/${id}`, 
        {},
        {'headers': {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        }}
        ).then((response) => {
            document.getElementById("status-"+id).innerHTML=response.data.button_label;
            document.getElementById("chng_status-"+id).innerHTML=response.data.post_status;
            alert(response.data.message);
        }).catch((error) => {
            console.log(error);
        });
}
</script>
@endsection