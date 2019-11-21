<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Post;

class PostController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('deleted_at', '0')->orderBy('updated_at','desc')->get();
        return view('list', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create', ['post' => new Post]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $posts = new Post;
        $posts->post_name = $request->title;
        $posts->slug = $request->slug;
        $posts->author_name = $request->author_name;
        $posts->content = $request->content;
        $posts->created_by = \Auth::user()->name;
        $posts->save();
        return redirect()->route('post.show', ['post' => $posts->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where([['slug', $slug], ['deleted_at', '0']])->firstOrFail();
        return view('show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where([['slug', $slug], ['deleted_at', '0']])->firstOrFail();
        return view('create', ['post' => $post, 'isEdit' => true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $posts = Post::where([['id', $request->id], ['deleted_at', '0']])->firstOrFail();
        $posts->post_name = $request->title;
        $posts->author_name = $request->author_name;
        $posts->content = $request->content;
        $posts->save();
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->user_type != 'admin') {
            abort(403, 'You are not authorized to delete post.');
        }
        $post = Post::where('id', $id)->firstOrFail();
        $post->deleted_at = '1';
        $post->save();
        return redirect()->route('post.index');
    }

    public function setStatus($id, Request $request) {
        $buttonLabel = '';
        $post = Post::where('id', $id)->firstOrFail();
        if('Published' == $post->status) {
            $post->status = 'Draft';
            $buttonLabel = 'Publish';
        } else {
            $post->status = 'Published';
            $buttonLabel = 'Draft';
        }
        $post->save();
        return [ 'message' => 'Status changed to '. $post->status . ' for post '. $post->post_name
            , 'button_label' => $buttonLabel ,
            'post_status' => $post->status
        ];
    }
}
