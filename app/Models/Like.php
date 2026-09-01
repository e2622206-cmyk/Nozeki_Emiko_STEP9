<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
    ];
    
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function user(): BelongsTo
{
    return $this->belongsTo(User::class);
}
}

