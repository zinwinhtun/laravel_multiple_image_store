<?php

namespace App\Http\Controllers;

use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function index(){
        $data = post::get();
        return view('blog',compact('data'));
    }

    public function store(Request $request): RedirectResponse
    {
        //validate request data
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'images' => 'required|array', //required
            'images.*' => 'required|image|mimes:png,jpg,svg,jpeg,gif|max:2048'
        ]);

        $images = [];
        foreach ($data['images'] as $image) {
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image_path =  $image->storeAs('images', $fileName, 'public');
            array_push($images, $image_path);
        }
        
        $data['images'] = $images;
        post::create($data);
        return redirect()->back();
    }

    public function destroy($id){
        post::findOrFail($id)->delete();
        return back();
    }
}
