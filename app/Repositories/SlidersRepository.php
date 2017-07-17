<?php
/**
 * The class SlidersRepository consist code to operate Sliders model
 */

namespace Corp\Repositories;

use Corp\Slider;

class SlidersRepository extends Repository
{
    public function __construct(Slider $slider)
    {
        parent::__construct($slider);
    }
}

