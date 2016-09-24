<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostsCreateRequest;
use App\Http\Requests\PostsEditRequest;

use App\Http\Requests;
use App\Post;
use Auth;
use App\Photo;
use App\Category;
use App\Tag;
use Session;
// use Purifier;
use Image;


class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(5);
        return view('admin.posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name', 'id')->all();
        $tags = Tag::all();
        return view('admin.posts.create')->with('categories', $categories)
                                         ->with('tags', $tags);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, array(
        'title' => 'required|max:255',
        'body' => 'required',
        // 'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
        'category_id' => 'required|integer',
        'photo_id' => 'sometimes|image'
      ));
      $input = $request->all();
      $slug=str_slug("$request->title" . time(),'_');

      $user = Auth::user();
      $post = new Post;
      $post->title = $request->title;
      $post->slug = $slug;
      $post->user_id = $user ->id;
      $post->body = $request->body;
      $post->category_id = $request->category_id;

      if ($file= $request -> file('photo_id')) {
        $name = 'post_photo' . time() . $file -> getClientOriginalExtension();

        // $filename = 'post_photo' . time() . '.' . $image->getClientOriginalExtension();
        // $location = public_path('images/' . $filename);

         $file->move('images', $name);
        // Storage::putFileAs('images', new File('/path/to/photo'), 'photo.jpg');
        // Inserts the photo to the photos table
        $photo = new Photo;
        $photo = Photo::create(['file' => $name]);
        // Inserts the photo_id key to the Posts Table
        // $input['photo_id'] = $photo->id;
        $post['photo_id'] = $photo->id;

        // Image::make($image)->resize(400,200)->save($location);

        // $post->file = $filename;

      }
      $post->save();
      $post->tags()->sync($request->tags, false);

      // $user->posts()->create($input);
      Session::flash('success', 'The post has been added!');

      return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $post = Post::find($id);
      $user = Auth::user();
      return view('admin.posts.show')->with('post', $post)->with('user', $user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $user = Auth::user();
        $categories = Category::lists('name','id')->all();

        $tags = Tag::all();
        $tags2 = array();
        foreach ($tags as $tag) {
          $tags2[$tag->id] = $tag->name;
        }

        return view('admin.posts.edit')->with('post', $post)
                                      ->with('categories', $categories)
                                      ->with('tags', $tags2)
                                      ->with('user', $user);
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
        $post = Post::findOrFail($id);
        $this->validate($request, array(
          'title' => 'required|max:255',
          'category_id' => 'required',
          'body' => 'required'
        ));
        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->category_id = $request->input('category_id');
        $post->body = $request->input('body');

        // $input = $request->all();

        if ($file = $request->file('photo_id')) {

          $name = 'post_photo' . time() . $file -> getClientOriginalExtension();

          $file->move('images', $name);
          
          $photo = Photo::create(['file' => $name]);

          // $input['photo_id'] = $photo->id;
          $photo_id=$photo->id;
          $post->photo_id=$photo_id;
        }
        $post->save();

        if(isset($request->tags)) {
          $post->tags()->sync($request->input('tags'));
        } else {
          $post->tags()->sync(array());
        }


        // Auth::user()->posts()->whereId($id)->first()->update($input);
        Session::flash('success', 'The post has been updated!');

        return redirect()->route('admin.posts.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::findOrFail($id);
      unlink(public_path() . $post->photo->file);

      $post->delete();

      Session::flash('success', 'The post has been deleted!');

      return redirect()->route('admin.posts.index');

    }
}
