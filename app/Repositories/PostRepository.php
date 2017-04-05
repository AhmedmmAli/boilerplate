<?php

namespace App\Repositories;

use App\Models\Post;
use InfyOm\Generator\Common\BaseRepository;

class PostRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'post_body',
        'status'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Post::class;
    }
}
