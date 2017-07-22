<?php
/**
 * This abstract class contains common methods for all repositories
 */

namespace Corp\Repositories;

use Config;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function get($select = '*',  $take = false)
    {
        $builder = $this->model->select($select);
//        dd($builder->get());
        if ($take) {
            $builder->take($take);
        }
        return $builder->get();
    }
}