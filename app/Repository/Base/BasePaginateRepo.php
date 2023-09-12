<?php
namespace App\Repository\Base;

class BasePaginateRepo{

    public $per_page;
    public $sort_by;
    public $sort_type;

    public function __construct()
    {
        request()->filled('per_page') ? $this->per_page = request()->per_page : $this->per_page =15;
        request()->filled('sort_by') ? $this->sort_by=request()->sort_by : $this->sort_by='id';
        request()->filled('sort_type') ? $this->sort_type=request()->sort_type : $this->sort_type='asc';
    }

}
