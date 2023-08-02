<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User_Address extends Model
{
    use HasFactory;
    protected $table='user_address';
    protected $guarded=[];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
