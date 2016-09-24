<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;
use Session;

class AdminMediasController extends Controller
{
    public function index()
    {
      $photos = Photo::all();
      return view('admin.media.index')->with('photos', $photos);
    }

    public function create()
    {
      return view('admin.media.create');
    }

    public function store(Request $request)
    {
      $file = $request->file('file');

      $name = time() . $file->getClientOriginalName();

      $file->move('images', $name);

      Photo::create(['file' => $name]);
    }

    public function destroy($id)
    {
      $photo = Photo::findOrFail($id);
      unlink(public_path() . $photo->file);
      $photo->delete();
      Session::flash('success', 'The photo has been deleted!');
      return redirect()->route('admin.media.index');
    }
}
