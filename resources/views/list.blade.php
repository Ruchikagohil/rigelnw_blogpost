@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center p-lg-4">Posts</h2>
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
                    <td>{{ $post->content }}</td>
                    <td>{{ $post->status}}</td>
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
            alert(response.data.message);
        }).catch((error) => {
            console.log(error);
        });
}
</script>
@endsection