<?php

namespace App\Http\Controllers;
use App\Post;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
use Session;

class PagesController extends Controller
{
    public function getIndex() {
      // process variable data or params
      // talk to the model -> database
      // recieve from the model <- database
      // compile or process data from the model if needed
      // pass that data to the correct view (dummy pages)
      $posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
      return view('pages.welcome')->with('posts', $posts);
    }

    public function getAbout() {
      $first = "Anastasia";
      $last = "Karamichailidou";
      $fullname = $last . " " . $first;
      $email = "a.karamichailidou@gmail.com";
      $data = [];
      $data['fullname'] = $fullname;
      $data['email'] = $email;
      return view('pages.about')->withData($data);
      // 2 different ways to pass params to a view
    }

    public function getContact() {
      return view('pages.contact');
    }

    public function postContact(Request $request) {
      $this->validate($request, array(
        'email'   => 'required|email',
        'subject' => 'min:3|max:255',
        'message' => 'min:10'
      ));
      $data = array(
        'email'       => $request->email,
        'subject'     => $request->subject,
        'bodyMessage' => $request->message
      );
      Mail::send('emails.contact', $data, function($message) use ($data){
        $message->from($data['email']);
        $message->to('otinanai1309@gmail.com');
        $message->subject($data['subject']);
      });
      Session::flash('success', 'Your Email was Sent!');
      return redirect('/');
    }

}
