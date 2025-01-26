<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    public    $timestamps = true;
    protected $fillable   = array(
        'transaction_date',
        'client_id',
        'total',
        'installment_fees',
        'installment_with_fees',
        'months_num',
        'installment_value',
        'investor_id'
    );
    protected $appends    = ['total'];

    public function installments()
    {
        return $this->hasMany('App\Models\Installment');
    }

    public function tracking()
    {
        return $this->hasOne(Tracking::class,'invoice_id');
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client', 'client_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'invoice_product')->withPivot('quantity', 'price');
    }
    public function investor()
    {
        return $this->belongsTo(Investor::class,'investor_id');
    }

    public function getNextInstallmentAttribute()
    {
        return $this->installments()->oldest('due_date')->whereNull('transaction_date')->first();
    }

    public function getLastInstallmentAttribute()
    {
        return $this->installments()->latest('due_date')->first();
    }

    public function scopeCompleted($query)
    {
        $query->whereNotNull('completed_at')->first();
    }

    public function scopeUnCompleted($query)
    {
        $query->whereNull('completed_at')->first();
    }

    public function getPaidAttribute()
    {
        return $this->installments()->where('transaction_date', '!=', null)->get();
    }
}
