<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gallery;

class Comment extends Model
{
    public function gallery()
    {
    	return $this->belongsTo(Gallery::class);
    }
}
