<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms_Message extends Model
{
    use HasFactory;
    protected $table='sms_messages';
    protected $guarded=[];
}
