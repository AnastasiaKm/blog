<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Logic\User\UserRepository;
use App\Models\Profile;
use App\Models\User;
use Validator;
use Input;
use App\Photo;
use Session;
use File;
use Image;


class ProfilesController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | User Profiles Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders the "View Profile" and "Edit Profile" pages.
    |
    */

    protected $auth;
    protected $userRepository;

    // RUN VIEW THROUGH AUTH MIDDLWARE via the CONSTRUCTOR
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function profile_validator(array $data)
    {
        return Validator::make($data, [
            // 'name'              => 'required',
            'first_name'        => 'required',
            'last_name'         => 'required',
            'location'          => '',
            'bio'               => '',
            'twitter_username'  => '',
            'github_username'   => ''
        ]);
    }

    /**
     * /username
     *
     * @param $username
     * @return Response
     */
    public function show($username)
    {
        try {
            $user = $this->getUserByUsername($username);
            //dd($user->toArray());
        } catch (ModelNotFoundException $e) {
            return view('pages.status')
                ->with('error',\Lang::get('profile.notYourProfile'))
                ->with('error_title',\Lang::get('profile.notYourProfileTitle'));
        }
        return view('profiles.show')->withUser($user);
    }

    /**
     * Fetch user
     * (You can extract this to repository method)
     *
     * @param $username
     * @return mixed
     */
    public function getUserByUsername($username)
    {
        return User::with('profile')->wherename($username)->firstOrFail();
    }

    /**
     * /profiles/username/edit
     *
     * @param $username
     * @return mixed
     */
    public function edit($username)
    {
        try {
            $user = $this->getUserByUsername($username);
        } catch (ModelNotFoundException $e) {
            return view('pages.status')
                ->with('error',\Lang::get('profile.notYourProfile'))
                ->with('error_title',\Lang::get('profile.notYourProfileTitle'));
        }
        return view('profiles.edit')->withUser($user);
    }

    /**
     * Update a user's profile
     *
     * @param $username
     * @return mixed
     * @throws Laracasts\Validation\FormValidationException
     */
    public function update($id, Request $request)
    {
        // $user = $this->getUserByUsername($username);
        $user = User::findOrFail($id);
        $input = Input::only('location', 'bio', 'twitter_username', 'github_username');
        $profile_validator = $this->profile_validator($request->all());

        if ($profile_validator->fails()) {

            $this->throwValidationException(
                $request, $profile_validator
            );

            return redirect('profile/'.$user->name.'/edit')->withErrors($validator)->withInput();
        }

        $oldfile = $user->avatar;

        $oldpsw= $user->password;

        if ($user->profile == null) {

            $profile = new Profile;

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');

            if (trim($request->password)=='') {
              $user->password = $oldpsw;
            } else {
              $user->password = bcrypt($request->input('password'));
            }
            if ($avatar = $request->file('avatar')) {
              $filename = time() . '.' . $avatar -> getClientOriginalExtension();
              Image::make($avatar)->resize(150,150)->save(public_path('images/' . $filename));
              $user->avatar=$filename;

              if($oldfile == 'default_avatar.tif') {

              } else {
                File::delete($oldfile);
              }
            }
            $user->save();
            $profile->fill($input);
            $user->profile()->save($profile);

        } else {
          $user->first_name = $request->input('first_name');
          $user->last_name = $request->input('last_name');

          if (trim($request->password)=='') {
            $user->password = $oldpsw;
          } else {
            $user->password = bcrypt($request->input('password'));
          }
          if ($avatar = $request->file('avatar')) {
            $filename = time() . '.' . $avatar -> getClientOriginalExtension();
            Image::make($avatar)->resize(150,150)->save(public_path('images/' . $filename));
            $user->avatar=$filename;

            if($oldfile == 'default_avatar.tif') {

            } else {
              File::delete($oldfile);
            }
          }
          $user->save();
          $user->profile->fill($input)->save();

        }

        return redirect('profile/'.$user->name.'/edit')->with('status', 'Profile updated!');

    }

}
