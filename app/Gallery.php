<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;
use App\Comment;
use App\User;

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

    public function author()
    {
    	return $this->belongsTo(User::class);
    }
}
