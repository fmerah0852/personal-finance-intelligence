<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'store_name',
        'date',
        'category',
        'total_amount',
        'items',
        'receipt_image_path',
    ];

    protected $casts = [
        'items' => 'array',
        'date'  => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
