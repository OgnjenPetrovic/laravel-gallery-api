<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Gallery;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Gallery::search(request('term', ''), request('take', 10), request('skip', 0), request('auth-user'));
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
    public function store(GalleryRequest $request)
    {
        $gallery = new Gallery;
        $gallery->name = $request->name;
        $gallery->description = $request->description;
        $gallery->user_id = JWTAuth::parseToken()->authenticate()->id;
        $gallery->save();

        $gallery->addImages($request->images);

        return $gallery->with('images')->whereId($gallery->id)->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Gallery::with(['images', 'comments', 'user'])->whereId($id)->first();
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
    public function update(GalleryRequest $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $gallery->name = $request->name;
        $gallery->description = $request->description;
        $gallery->user_id = JWTAuth::parseToken()->authenticate()->id;

        $gallery->deleteImages();

        $gallery->addImages($request->images);

        return $gallery->with('images')->whereId($id)->get();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();

        return new JsonResponse('Gallery successfully deleted');
    }
}
