<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use App\Photo;
use App\Category;
use App\Tag;
use App\Comment;
use App\Http\Flash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $posts = Post::orderBy('id', 'desc')->take(6)->get();
      $categories = Category::orderBy('id', 'desc')->take(5)->get();
      $tags = Tag::orderBy('id', 'desc')->take(5)->get();
      $comments = Comment::orderBy('id', 'desc')->take(5)->get();
      // where('photo_id', '<>', "")->
  		$photos = array();
  		foreach ($posts as $post) {
  			if($post->photo_id) {
  				$photos[$post->photo_id] = Photo::findOrFail($post->photo_id);
  			} else {
  				$photos[] = "";
  			}
  		}
  		// return dd($comments);
      // flash()->overlay('Welcome Aboard!', 'You are logged in!');

  		return view('pages.home')->with('posts', $posts)
                               ->with('photos', $photos)
                               ->with('categories', $categories)
                               ->with('comments', $comments)
                               ->with('tags', $tags);
    }

    public function getHome()
    {
        return view('pages.home');
    }

}
