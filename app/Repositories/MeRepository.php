<?php

namespace App\Repositories;

use App\Models\Me;
use InfyOm\Generator\Common\BaseRepository;

class MeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'text'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Me::class;
    }
}
