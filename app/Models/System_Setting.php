<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System_Setting extends Model
{
    use HasFactory;
    protected $table='system_settings';
    protected $guarded=[];
}
