<?php namespace App\Http\Controllers;

use App\Http\Flash;
use App\Post;
use App\Photo;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{

		return view('app');
	}

	public function home()
	{
		$posts = Post::orderBy('id', 'desc')->take(6)->where('photo_id', '<>', "")->get();
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

}
