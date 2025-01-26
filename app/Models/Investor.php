<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'phone',
        'capital',
        'total_benefits',
        'note'
    ];

    public function invoice()
    {
        return $this->hasMany(Invoice::class,'investor_id');
    }

    public function sumBenifits()
    {
        return $this->invoice()->sum('installment_fees')  ;
    }
}
