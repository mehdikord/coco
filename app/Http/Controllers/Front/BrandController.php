<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\Brands\BrandsInterface;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected BrandsInterface $repository;
    public function __construct(BrandsInterface $brands)
    {
        $this->repository = $brands;
    }

    public function index()
    {
        return $this->repository->front_index();
    }
}
