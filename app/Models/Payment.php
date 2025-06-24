<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car',
        'price',
        'image',
        'pickup_date',
        'return_date',
        'payment_method',
        'payment_details',
    ];

    protected $casts = [
        'payment_details' => 'array',
        'pickup_date' => 'date',
        'return_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function logs()
    {
        return $this->hasMany(PaymentLog::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}