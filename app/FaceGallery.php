<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FaceGallery extends Model
{
    //
    protected $table = 'face_gallery';


    protected $fillable = ['image'];
}
