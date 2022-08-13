<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'type',
        'quantity_in_stock',
        'price'
    ];

    public function companies()
    {
        return $this->belongsToMany(Company::class, 'company_product');
    }
}
