<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Session;

class CategoryController extends Controller
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
        // display a view of all categories
        $categories = Category::all();

        // have a form to create a new category
        return view('categories.index')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // save a new category and redirect back to index
        $this->validate($request, array(
          'name' => 'required|max:255'
        ));

        $category = new Category;
        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'New category has been created');

        return redirect()->route('categories.index');
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
      // Find the category in the database and save it as a variable
      $category = Category::find($id);

      // return the view and pass in the var we previously created
      return view('categories.edit')->with('category', $category);

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
      $category = Category::find($id);
      $category->name = $request->input('name');
      $category->save();

      // set flash data with success message
      Session::flash('success', 'This category was successfully updated.');

      // redirect with flash data to posts.show
      return redirect()->route('categories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category = Category::find($id);
      $category->delete();
      Session::flash('success', 'The category was successfully deleted!');
      return redirect()->route('categories.index');

    }
}
