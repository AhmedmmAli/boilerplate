<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;

class PostsTranslation extends Model
{
     public $timestamps = false;
    protected $fillable = ['text'];
}
