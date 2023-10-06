<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\Interfaces\Helper\HelperInterface;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    protected HelperInterface $repository;
    public function __construct(HelperInterface $helper)
    {
        $this->repository = $helper;
    }

    public function provinces()
    {
        return $this->repository->provinces();
    }

    public function shipping()
    {
        return $this->repository->shipping();
    }
}
