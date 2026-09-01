<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'company_name',
    ];
    
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
