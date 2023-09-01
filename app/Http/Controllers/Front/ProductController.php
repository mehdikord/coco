<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\Products\ProductsInterface;


class ProductController extends Controller
{

    protected ProductsInterface $repository;
    public function __construct(ProductsInterface $products)
    {
        $this->repository=$products;
    }

    public function index()
    {

        return $this->repository->front_index();
    }
}
