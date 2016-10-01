<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Session;

class AuthorCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::orderBy('name')->paginate(10);
      return view('author.categories.index')->with('categories', $categories);

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
      Category::create($request->all());
      Session::flash('success', 'The category has been added!');
      return redirect()->route('author.categories.index');
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
      $category = Category::findOrFail($id);
      return view('author.categories.edit')->with('category', $category);

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
      $category = Category::findOrFail($id);
      $category->update($request->all());
      Session::flash('success', 'The category has been updated!');
      return redirect()->route('author.categories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Category::findOrFail($id)->delete();
      Session::flash('success', 'The category has been deleted!');
      return redirect()->route('author.categories.index');

    }
}
