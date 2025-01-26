<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'tracking_number',
        'state'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }
}
