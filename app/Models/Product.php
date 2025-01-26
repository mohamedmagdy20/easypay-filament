<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = array('name', 'warinty_number', 'installment_commission','supplier_id','price_in','price_out','stock','img');



    public function invoices()
    {
        return $this->hasMany('App\Models\Invoice');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

}
