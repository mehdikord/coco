<?php

namespace App\Http\Controllers\Manage\Slider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Single\SingleImageUpdateRequest;
use App\Http\Requests\Slider\SliderStoreRequest;
use App\Http\Requests\Slider\SliderUpdateRequest;
use App\Interfaces\Slider\SliderInterface;
use App\Models\Slider;
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
        return $this->repository->index();
    }

    public function store(SliderStoreRequest $request)
    {
        return $this->repository->store($request);
    }

    public function update(Slider $brand,SliderUpdateRequest $request)
    {
        return $this->repository->update($request,$brand);
    }

    public function delete(Slider $brand)
    {
        return $this->repository->delete($brand);
    }

    public function update_image(Slider $brand,SingleImageUpdateRequest $request)
    {
        return $this->repository->update_image($request,$brand);
    }
}
