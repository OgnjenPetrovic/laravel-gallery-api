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
            $image->url = $imageUrl;
            $imagesToSave[] = $image;
        }
        $this->images()->saveMany($imagesToSave);
    }

    public static function search($term, $take, $skip)
    {
        return self::join('users', 'user_id', '=' , 'users.id')
            ->where('name', 'like', '%' . $term . '%')
            ->orWhere('description', 'like', '%' . $term . '%')
            ->orWhere('users.first_name', 'like', '%' . $term . '%')
            ->orWhere('users.last_name', 'like', '%' . $term . '%')
            ->skip($skip)->take($take)->get();
    }

    public static function validationRules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'description' => 'required|max:1000',
            'images' => 'required|array|min:1',
            'images.*' => 'required|url'
        ];
    }
}
