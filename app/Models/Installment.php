<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Installment extends Model
{
    use HasFactory;
    public    $timestamps = true;
    protected $fillable   = array('amount', 'transaction_date', 'due_date', 'note', 'invoice_id');

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function scopeLate($query)
    {
        $now = Carbon::now()->format('Y-m-d');
        $beforeWeek = Carbon::now()->subWeek()->format('Y-m-d');
        $query->whereBetween('due_date', [$now, $beforeWeek])
            ->whereNull('transaction_date');

    }

    public function scopeUnpaid($query)
    {
        $query->whereNull('transaction_date');
    }

    public function scopeUpcoming($query)
    {
        $now = Carbon::now()->format('Y-m-d');
        $afterWeek = Carbon::now()->addWeek()->format('Y-m-d');
        $query->whereBetween('due_date', [$now, $afterWeek])
              ->whereNull('transaction_date');
    }
}
