<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Redirect;
use App\Models\User;
use Input;

class FollowsController extends Controller
{

    /**
     * Follow a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $user = Auth::user();
        // $input = array_add(Input::get(), 'user_id', Auth::id());
        $userIdToFollow = $request->userIdToFollow;
        // $user = User::findOrFail($user_id);
        $user = $user->follows()->attach($userIdToFollow);
        // $userToFollow = $user->follow($input->userIdToFollow);

        flash()->success('Success!', 'You are now following this user!');
        return Redirect::back();
    }


    /**
     * Unfollow a user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userIdToUnfollow)
    {
        Auth::user()->follows()->detach($userIdToUnfollow);

        flash()->success('Success!', 'You are not following this user anymore!');

        return Redirect::back();
    }
}
