<?php

namespace App\Http\Controllers;

use App\Gallery;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class UserGalleryController extends Controller
{
    public function index($id)
    {
        return Gallery::with(['images', 'comments', 'user'])->where('user_id', '=', $id)->get();
    }

    public function loggedUser()
    {
        return Gallery::with(['images', 'comments', 'user'])->where('user_id', '=', JWTAuth::parseToken()->authenticate()->id)->get();
    }
}
