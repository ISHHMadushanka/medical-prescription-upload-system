<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = ['prescription_id', 'drug', 'quantity', 'amount'];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}
