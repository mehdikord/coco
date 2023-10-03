<?php
namespace App\Repository\Helper;


use App\Interfaces\Helper\HelperInterface;
use App\Models\Province;

class HelperRepository implements HelperInterface
{

    public function provinces()
    {
        return response_success(Province::with('cities')->get());
    }

}
