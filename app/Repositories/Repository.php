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

    public function get()
    {
        $builder = $this->model->select('*');
//        dd($builder->get());
        return $builder->get();
    }
}