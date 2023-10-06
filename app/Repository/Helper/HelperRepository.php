<?php
namespace App\Repository\Helper;


use App\Interfaces\Helper\HelperInterface;
use App\Models\Province;
use App\Models\Shipment;

class HelperRepository implements HelperInterface
{

    public function provinces()
    {
        return response_success(Province::with('cities')->get());
    }

    public function shipping()
    {
        return response_success(Shipment::where('is_active',true)->orderByDesc('id')->get());
    }

}
