<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User_Address extends Model
{
    use HasFactory;
    protected $table='user_addresses';
    protected $guarded=[];

    public function province()
    {
        return $this->belongsTo(Province::class,'province_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
