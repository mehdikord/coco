<?php

namespace App\Http\Controllers\User\Address;

use App\Http\Controllers\Controller;
use App\Interfaces\Users\UsersInterface;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected UsersInterface $repository;
    public function __construct(UsersInterface $users)
    {
        $this->repository = $users;
    }

    public function index()
    {
        return $this->repository->user_address_index();
    }


}
