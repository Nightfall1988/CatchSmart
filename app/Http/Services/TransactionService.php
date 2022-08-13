<?php

namespace App\Http\Services;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use App\Models\CompanyProduct;
use App\Models\Company;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class TransactionService 
{
    private Company $company;

    private Product $product;

    public function __construct(Company $company, Product $product)
    {
        $this->company = $company;
        $this->product = $product;
    }

    public function addTransaction(Request $request)
    {
        $company = Company::where('name', '=', $request->company)
            ->get()
            ->first();

        $product = Product::where('name', '=', $request->product)
            ->get()
            ->first();

        $newInStock = $product->quantity_in_stock - intval($request->quantity);

        if ($newInStock >= 0) {
            $product->quantity_in_stock = $newInStock;
            $product->save();
            $company->products()->attach($product, ['quantity'=>$request->quantity, 'total'=>$request->price]);
        } else {
            redirect('views/errors/403');
        }
    }

    public function getAllTransactionsByCompany(string $id)
    {
        $transactions = DB::table('company_product')
        ->where('company_id', '=', $id)
        ->join('products', 'products.id', '=', 'company_product.product_id')
        ->get();

        return $transactions;
    }

    public function getAllTransactionsByProduct(string $id)
    {
        $transactions = DB::table('company_product')
        ->where('product_id', '=', $id)
        ->join('companies', 'companies.id', '=', 'company_product.company_id')
        ->get();
        return $transactions;
    }
}