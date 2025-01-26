<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable   = [
        'name',
        'address',
        'phone',
        'national_id',
        'national_id_photo',
        'notes'
    ];


    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice', 'client_id');
    }

}
