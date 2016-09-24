<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use Session;

class AdminTagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tags = Tag::orderBy('name')->paginate(10);
      return view('admin.tags.index')->with('tags', $tags);

    }

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
      $this->validate($request, array(
        'name' => 'required|max:255'
      ));
      $tag = new Tag;
      $tag->name = $request->name;
      $tag->save();

      Session::flash('success', 'The tag has been added!');
      return redirect()->route('admin.tags.index');

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

      return view('admin.tags.show')->with('tag', $tag);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $tag = Tag::findOrFail($id);
      return view('admin.tags.edit')->with('tag', $tag);

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
      $this->validate($request, array(
        'name' => 'required|max:255'
      ));
      $tag = Tag::findOrFail($id);
      $tag->name = $request->input('name');
      $tag->save();

      Session::flash('success', 'The tag has been updated!');
      return redirect()->route('admin.tags.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $tag = Tag::findOrFail($id);
      $tag->posts()->detach();
      $tag->delete();

      Session::flash('success', 'The tag has been deleted!');
      return redirect()->route('admin.tags.index');

    }
}
