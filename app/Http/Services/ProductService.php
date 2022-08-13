<?php

namespace App\Http\Services;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CompanyProduct;
use Illuminate\Database\Eloquent\Collection;

class ProductService 
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function save(Request $request)
    {
        $this->product = Product::firstOrCreate([
            'name' => $request->name,
            'quantity_in_stock' => $request->quantity_in_stock,
            'price' => $request->price,
            'type' => $request->type,
        ]);

        return $this->product;
    }

    public function getAllProducts()
    {
        return Product::all();
    }
    
    public function getProduct(string $id): Product
    {
        return Product::where('id', $id)->get()->firstOrFail();
    }

    public function getProductCompanies(string $id): Collection
    {
        return Product::with('companies')->find($id)->companies;
    }

    public function getProductsAjax(Request $request): Collection
    {
        return CompanyProduct::where('company_id', '=', $request->company_id)->get();
    }
}