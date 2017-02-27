<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use Auth;
use App\Photo;
use App\Category;
use App\Tag;
use App\Models\User;
use Session;
use Purifier;
use Image;
use App\Http\Flash;



class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $all_posts = Post::orderBy('id', 'desc')->get();
      $posts 			        = \DB::table('posts')->get();

      $total_posts 	        = \DB::table('posts')->count();

      $attemptsAllowed        = 4;

      $total_posts_confirmed  = \DB::table('posts')->count();

      return view('posts.index', [
          'all_posts'               => $all_posts,
          'posts' 		          		=> $posts,
          'total_posts' 	      		=> $total_posts,
          'total_posts_confirmed'   => $total_posts_confirmed,
        ]
      );
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
      return view('posts.create')->with('categories', $categories)
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
      $name = 'post_photo' . '_' . time() . '.' . $file -> getClientOriginalExtension();

      // $filename = 'post_photo' . time() . '.' . $image->getClientOriginalExtension();
      // $location = public_path('images/' . $filename);

       $file->move('images', $name);
      // Storage::putFileAs('images', new File('/path/to/photo'), "$name");
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
      // Session::flash('success', 'The post has been added!');
      // flash('Success!', 'Post has been added!');

      flash()->success('Success!', 'Post has been added!');

      return redirect()->route('posts.index');

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
      $user = Auth::user();
      if ($post->photo_id) {
      $photo = Photo::findOrFail($post->photo_id);
      } else {
      $photo = "";
      }
      $photos = array();
      foreach ($post->comments as $comment) {
      $user_id = $comment->user_id;
      $comment_user = User::findOrFail($user_id);
      $avatar = $comment_user->avatar;
      $photos[$comment->id] = $comment_user->avatar;
      }
      return view('posts.show')->with('post', $post)->with('photo', $photo)->with('user', $user)->with('photos', $photos);
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

      return view('posts.edit')->with('post', $post)
                                ->with('categories', $categories)
                                ->with('tags', $tags2)
                                ->with('user', $user);

    }

    public function edit_all()
    {
      $user = \Auth::user();
      if (Auth::user()->hasRole('administrator')) {
        $posts = Post::all();
        $total_posts 	        = \DB::table('posts')->count();

        $attemptsAllowed        = 4;

        $total_posts_confirmed  = \DB::table('posts')->count();
      } else {
        $posts = Post::where('user_id', $user->id)->get();
        $total_posts 	        = \DB::table('posts')->where('user_id', '=', $user->id)->count();

        $attemptsAllowed        = 4;

        $total_posts_confirmed  = \DB::table('posts')->where('user_id', '=', $user->id)->count();
      }

      return view('posts.edit-all', [
          'posts' 		          		=> $posts,
          'total_posts' 	      		=> $total_posts,
          'attemptsAllowed'         => $attemptsAllowed,
          'total_posts_confirmed'   => $total_posts_confirmed,
          'user'                    => $user,
        ]
      );
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

      $name = 'post_photo' . '_' . time() . '.' . $file -> getClientOriginalExtension();

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
    // Session::flash('success', 'The post has been updated!');

    flash()->success('Success!', 'Post has been updated!');


    return redirect()->route('posts.index');


    }

    public function delete($id)
    {
      $post = Post::find($id);
      return view('posts.delete')->with('post', $post);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Post::findOrFail($id)->delete();
      // Session::flash('success', 'The category has been deleted!');
      flash()->success('Success!', 'The post has been deleted!');

      return redirect()->route('posts.index');
    }
}
