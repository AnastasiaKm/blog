<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Photo;
use App\User;
use Session;
use File;
use Image;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $user = User::findOrFail($id);
    //     return view('profile/index')->with('user', $user);
    //
    // }

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
    public function store(Request $request)
    {
        //
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
      $user = User::findOrFail($id);
      // return dd($user);
      return view('author.profile.edit')->with('user', $user);
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
      $user = User::findOrFail($id);
      $this->validate($request, array(
        'name'          => 'required',
        'email'         => 'required'
      ));

      $oldfile = $user->avatar;
      $user->name = $request->input('name');
      $user->email = $request->input('email');

      $oldpsw= $user->password;

      if (trim($request->password)=='') {

        $user->password = $oldpsw;

      } else {

        $user->password = bcrypt($request->input('password'));

      }

      if ($avatar = $request->file('avatar')){
        $filename = time() . '.' . $avatar->getClientOriginalExtension();
        Image::make($avatar)->resize(300,300)->save(public_path('images/' . $filename));
        $user->avatar=$filename;
        if($oldfile == 'default_avatar.tif') {

        } else {
          File::delete($oldfile);
        }
      }
      $user->save();
      return view('author.profile.edit')->with('user', $user);

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
