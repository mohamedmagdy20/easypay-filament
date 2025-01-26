<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'phone',
        'personal_id',
        'amount',
        'date_income',
        'iban'
    ];

    protected $guarded = [];

    // Relationships
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
