<?php
namespace App\Repository\Shopping;


use App\Interfaces\Shopping\ShoppingInterface;


class ShoppingRepository implements ShoppingInterface
{

    public function user_start ($request)
    {
        return $request->all();

    }
}
