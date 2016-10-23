<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Post;
use App\Photo;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::orderBy('id', 'desc')->take(5)->where('photo_id', '<>', "")->get();
  		$photos = array();
  		foreach ($posts as $post) {
  			if($post->photo_id) {
  				$photos[$post->photo_id] = Photo::findOrFail($post->photo_id);
  			} else {
  				$photos[] = "";
  			}
  		}
  		// return dd($posts);
  		return view('pages.home')->with('posts', $posts)->with('photos', $photos);
    }

    public function getHome()
    {
        return view('pages.home');
    }

}
