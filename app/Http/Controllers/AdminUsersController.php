<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UsersRequest;
use App\User;
use App\Role;
use App\Photo;
use Session;
use File;
use Image;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::paginate(5);
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::lists('name', 'id')->all();
        return view('admin.users.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {

        $input = $request->all();

        $filename = 'default_avatar.tif';

        if ($avatar = $request->file('avatar')) {
          $filename = time() . '.' . $avatar -> getClientOriginalExtension();
          Image::make($avatar)->resize(150,150)->save(public_path('images/' . $filename));
          $user->avatar=$filename;
        }

        $input['password'] = bcrypt($request->password);
        User::create($input);

        Session::flash('success', 'The user has been created!');

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return view('admin.users.show');
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
      $roles = Role::lists('name', 'id')->all();
      return view('admin.users.edit')->with('user', $user)->with('roles', $roles);
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
          'email'         => 'required',
          'role_id'       => 'required',
          'is_active'    =>'required'
        ));

        $oldfile = $user->avatar;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role_id = $request->input('role_id');
        $user->is_active = $request->input('is_active');
        $oldpsw= $user->password;
        if (trim($request->password)=='') {
          $user->password = $oldpsw;
        } else {
          $user->password = bcrypt($request->input('password'));
        }
        // if ($request ->hasFile('photo_id')) {
        //   $file = $request-> file('photo_id');
        //   $file -> getClientOriginalName();
        //   $image_path = time() . $file();
        //   $file->move('images', $image_path)->resize(50,50)->save($file);
        // }

        // if (trim($request->password) == '') {
        //   $oldPassword = $user->password;
        //   $input = $request->except('password');
        //   $input['password'] = $oldPassword;
        // } else {
        //   $input = $request->all();
        // }
        //
        // $this->validate($request, array(
        //   'password' => 'required'
        // ));


        // *****************************************
        if ($avatar = $request->file('avatar')) {
          $filename = time() . '.' . $avatar -> getClientOriginalExtension();
          Image::make($avatar)->resize(150,150)->save(public_path('images/' . $filename));
          $user->avatar=$filename;

          if($oldfile == 'default_avatar.tif') {

          } else {
            File::delete($oldfile);
          }
        }
        // **********************************************



        // $input['password'] = bcrypt($request->password);

        $user->save();

        Session::flash('success', 'The user has been updated!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $avatar = $user->avatar;
        if ($avatar == 'default_avatar.tif') {
          $user->delete();
        } else{
        unlink(public_path('images/' . $avatar));
        $user->delete();
        }

        Session::flash('success', 'The user has been deleted!');

        return redirect()->route('admin.users.index');
    }
}
