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

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function deleteImages()
    {
        $this->images()->delete();
    }

    public function addImages($images)
    {
        foreach ($images as $imageUrl) {
            $image = new Image;
            $image->url = $imageUrl['url'];
            $imagesToSave[] = $image;
        }
        $this->images()->saveMany($imagesToSave);
    }

    public static function search($term, $take, $skip)
    {
        return self::with(['user', 'images'])
            ->skip($skip)->take($take)->orderBy('created_at', 'DESC')->get();
    }
}
