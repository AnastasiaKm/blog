<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Comment;
use App\User;
use Session;
use Auth;


class AdminCommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {

      $this->validate($request, array(
      'comment' => 'required|min:5|max:2000'
      ));

      $post = Post::findOrFail($post_id);
      $user = Auth::user();

      $comment = new Comment();

      $comment->comment = $request->comment;
      $comment->approved = true;
      $comment->post()->associate($post);
      $comment->user()->associate($user);
      $comment->user_id = $user->id;
      $comment->post_id = $post_id;

      $comment->save();

      Session::flash('success', 'Comment was added!');


      return redirect()->route('admin.posts.show', [$post->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $comment = Comment::find($id);
      return view('admin.comments.edit')->with('comment', $comment);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $comment = Comment::find($id);

      $this->validate($request, array(
      'comment' => 'required'
      ));

      $comment->comment = $request->comment;
      $comment->save();

      Session::flash('success', 'The comment was successfully updated!');

      return redirect()->route('admin.posts.show', $comment->post->id);

    }

    public function delete($id)
    {
      $comment = Comment::find($id);
      return view('admin.comments.delete')->with('comment', $comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $comment = Comment::find($id);
      $post_id = $comment->post->id;
      $comment->delete();

      Session::flash('success', 'The comment deleted!');

      return redirect()->route('admin.posts.show', $post_id);

    }
}
