<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\Slider\SliderInterface;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected SliderInterface $repository;
    public function __construct(SliderInterface $slider)
    {
        $this->repository = $slider;
    }

    public function index()
    {
        return $this->repository->front_index();
    }

}
