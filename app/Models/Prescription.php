<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'note',
        'delivery_address',
        'delivery_time',
        'images',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
