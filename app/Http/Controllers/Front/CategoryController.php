<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Interfaces\Categories\CategoriesInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoriesInterface $repository;
    public function __construct(CategoriesInterface $categories)
    {
        $this->repository = $categories;
    }

    public function index()
    {
        return $this->repository->front_index();
    }
}
