<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\ProductService;
use \Illuminate\Support\ItemNotFoundException;

class ProductController extends Controller
{
    private ProductService $service;

    public function __construct(ProductService $productService)
    {
        $this->service = $productService;
    }

    public function show()
    {
        return view('/product-list');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'quantity_in_stock' => 'numeric',
            'type' => 'required|max:255',
            'price' => 'required|numeric'
        ]);
    }

    public function add(Request $request)
    {
        return view('add-product');
    }

    public function addProduct(Request $request)
    {
        $this->store($request);
        $this->service->save($request);
        $products = $this->service->getAllProducts();

        return view('/product-list', ["products" => $products]);
    }

    public function getAllProducts()
    {
        $products = $this->service->getAllProducts();
        return view('product-list', ['products' => $products]);
    }

    public function getProduct(string $id)
    {
        try {
            $product = $this->service->getProduct($id);
            $companies = $this->service->getProductCompanies($id);
        } catch (ItemNotFoundException $e) {
            return view('errors/404');
        }
        
        return view('product-profile', ['product' => $product, 'companies' => $companies]);
    }

    public function getProductAjax(string $id)
    {
        $product = $this->service->getProduct($id);
        return $product;
    }

    public function getAllProductsAjax(Request $request)
    {
        $products = $this->service->getAllProducts();
        return $products;
    }
}
