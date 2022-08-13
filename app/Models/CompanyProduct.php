<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\Company;
use App\Models\Product;

class CompanyProduct extends Pivot
{
    use HasFactory;

    protected $table = 'company_product';

    protected $fillable = [
        'company_id',
        'product_id',
        'quantity',
        'total'
    ];

    public function company() {
        return $this->belongsTo('App\Models\Company');
      }
    
    public function product() {
        return $this->belongsTo('App\Models\Product');
    }
}
