<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;
use App\Comment;

class Gallery extends Model
{
    public function images() 
    {
    	return $this->hasMany(Image::class);
    }

    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }
}
