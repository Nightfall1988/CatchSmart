<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\TransactionService;
use App\Http\Services\CompanyService;
use App\Http\Services\ProductService;
use App\Models\Company;
use App\Models\Product;

class TransactionController extends Controller
{
    private TransactionService $transactionService;

    private CompanyService $companyService;

    private ProductService $productService;

    public function __construct(
        TransactionService $transactionService,
        CompanyService $companyService,
        ProductService $productService
    )
    {
        $this->transactionService = $transactionService;
        $this->companyService = $companyService;
        $this->productService = $productService;
    }

    public function getAllTransactionsByCompany(string $id)
    {
        return $this->transactionService->getAllTransactionsByCompany($id);
    }

    public function getAllTransactionsByProduct(string $id)
    {
        return $this->transactionService->getAllTransactionsByProduct($id);
    }

    public function saveTransaction(Request $request)
    {
        return $this->transactionService->addTransaction($request);
    }
}
