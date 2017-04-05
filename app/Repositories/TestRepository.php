<?php

namespace App\Repositories;

use App\Models\Test;
use InfyOm\Generator\Common\BaseRepository;

class TestRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'test'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Test::class;
    }
}
