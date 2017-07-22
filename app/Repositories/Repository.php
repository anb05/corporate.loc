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

    /**
     * @param string|array $select These are the field names in database
     * @param integer|bool $take   This is a number of items
     *
     * @return mixed
     */
    public function get($select = '*', $take = false)
    {
        $builder = $this->model->select($select);
//        dd($builder->get());
        if ($take) {
            $builder->take($take);
        }
        return $this->check($builder->get());
    }

    protected function check($result)
    {
        if ($result->isEmpty()) {
            return false;
        }

        $result->transform(function ($item, $key) {
            if (is_string($item->img) && is_object(json_decode($item->img)) && (json_last_error() == JSON_ERROR_NONE) ) {
                $item->img = json_decode($item->img);
            }
            return $item;
        });

        return $result;
    }
}