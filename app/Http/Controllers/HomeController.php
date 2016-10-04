<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

use App\Post;
use App\Comment;

class HomeController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    // public function welcome()
    // {
    //   $posts = Post::all();
    //   $comments = Comment::orderBy('post_id', 'asc');
    //
    //
    //
    //  $comments_per_post = DB::table('comments')
    //                         ->select('post_id', DB::raw('count(*) as total'))
    //                         ->groupBy('post_id')
    //                         ->lists('total','post_id');
    // $solution = array();
    // foreach ($comments_per_post as $post_id => $total) {
    // $solution['post_id']=$total;
    // }
    //
    //
    //   // foreach ($comments as $comment) {
    //   //
    //   //   $comments_per_post[$post->comments()->count()] = $post->id;
    //   //   // $top_comments=[['post_id'=>$post->id],['count'=>$post->comments()->count()]];
    //   // }
    //   // $comments_per_post=array_values(array_sort($comments_per_post, function($value){
    //   //   return $value['total'];
    //   // }));
    //
    //   return dd($solution);
    //
    //
    //
    // }
}
