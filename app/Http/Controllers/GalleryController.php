<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use Validator;
use App\Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Gallery::with('images')->with('comments')->with('author')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->json()->all();


        $validation = Validator::make($input, [
            'name' => 'required|min:2|max:255',
            'description' => 'required|max:1000',
            'images' => 'required|array|min:1',
            'images.*.url' => 'required|url'
        ]);



        if ($validation->fails()) {
             return $validation->errors();
        }

        $gallery = new Gallery;
        $gallery->name = $input['name'];
        $gallery->description = $input['description'];
        $gallery->user_id = 3;
        $gallery->save();   

        $images = $input->images;
        foreach ($images as $image) {
           $gallery->images()->save($image);
        }

        return $gallery;
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
        //
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
        //
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
