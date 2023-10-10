<?php

namespace App\Http\Controllers\Front\System;

use App\Http\Controllers\Controller;
use App\Interfaces\Callback\CallbackInterface;
use Illuminate\Http\Request;

class PaymentCallbackController extends Controller
{
    protected CallbackInterface $repository;

    public function __construct(CallbackInterface $callback)
    {
        $this->repository = $callback;
    }


    public function bitpay(Request $request)
    {
        return $this->repository->bitpay($request);
    }
}
