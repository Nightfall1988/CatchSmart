<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    
    protected $fillable = [
        'name',
        'type',
        'address',
        'phone',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'company_product')->withTimestamps()->withPivot('total');
    }
}
