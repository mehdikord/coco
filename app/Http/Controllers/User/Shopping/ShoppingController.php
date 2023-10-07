<?php

namespace App\Http\Controllers\User\Shopping;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shopping\ShoppingRequest;
use App\Interfaces\Shopping\ShoppingInterface;
use Illuminate\Http\Request;

class ShoppingController extends Controller
{
    protected ShoppingInterface $repository;

    public function __construct(ShoppingInterface $shopping)
    {
        $this->repository = $shopping;
    }

    public function start(ShoppingRequest $request)
    {
        return $this->repository->user_start($request);
    }
}
