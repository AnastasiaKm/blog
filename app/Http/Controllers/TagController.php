<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use Session;

class TagController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index')->with('tags', $tags);
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
          'name' => 'required|max:255'
        ));
        $tag = new Tag;
        $tag->name = $request->name;
        $tag->save();

        Session::flash('success', 'New tag was successfully created!');
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);

        return view('tags.show')->with('tag', $tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      // Find the tag in the database and save it as a variable
      $tag = Tag::find($id);

      // return the view and pass in the var we previously created
      return view('tags.edit')->with('tag', $tag);

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
      // Validate tha data
      $this->validate($request, array(
        'name' => 'required|max:255'
      ));

      // Save the data to the database
      $tag = Tag::find($id);
      $tag->name = $request->input('name');
      $tag->save();

      // set flash data with success message
      Session::flash('success', 'This tag was successfully updated.');

      // redirect with flash data to posts.show
      return redirect()->route('tags.show', $tag->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $tag = Tag::find($id);
      $tag->posts()->detach();

      $tag->delete();

      Session::flash('success', 'The tag was successfully deleted!');
      return redirect()->route('tags.index');

    }
}
