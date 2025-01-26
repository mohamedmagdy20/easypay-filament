<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Transaction extends Model
{
    use HasFactory;
    
    protected $fillable =[ 
        'amount',
        'profit',
        'wallet_id',
        'date'
    ];
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    // Relationships
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
