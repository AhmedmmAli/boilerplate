<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Dimsav\Translatable\Translatable;
/**
 * Class Posts
 * @package App\Models
 * @version March 19, 2017, 2:25 pm UTC
 */
class Posts extends Model
{
    
   
    use SoftDeletes;
    use Translatable;
    public $translationModel = 'App\Models\PostsTranslation';
    public $translatedAttributes = ['text'];
    

    public $table = 'posts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'text'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'text' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'text' => 'required'
    ];
}

