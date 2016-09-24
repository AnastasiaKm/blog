<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostsCreateRequest;
use App\Post;
use App\Category;
use Auth;
use App\Photo;
use App\Tag;
use Session;
use Purifier;
use Image;


use App\Http\Requests;

class AuthorPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::all();
      return view('author.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::lists('name', 'id')->all();
      // $tags = Tag::all();
      return view('author.posts.create')->with('categories', $categories)->with('tags', $tags);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
      $this->validate($request, array(
        'title' => 'required|max:255',
        'body' => 'required',
        // 'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
        'category_id' => 'required|integer',
        'featured_image' => 'sometimes|image'
      ));
      // $input = $request->all();

      $user = Auth::user();
      $post = new Post;
      $post->title = $request->title;
      // $post->slug = $request->slug;
      $post->body = Purifier::clean($request->body);
      $post->category_id = $request->category_id;

      if ($image = $request->file('featured_image')) {

        $filename = time() . '.' . $image->getClientOriginalExtension();

        $location = public_path('images/' . $filename);

        // $file->move('images', $name);

        // $photo = Photo::create(['file' => $name]);
        //
        // $input['photo_id'] = $photo->id;
        Image::make($image)->resize(400,200)->save($location);

        $post->file = $filename;

      }
      $post->save();
      $post->tags()->sync($request->tags, false);

      // $user->posts()->create($input);
      Session::flash('success', 'The post has been added!');

      return redirect()->route('author.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('author.posts.show')->with('post', $post);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
