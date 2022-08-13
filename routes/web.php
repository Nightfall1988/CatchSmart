<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('firstpage');
});

Route::get('/add-company', [CompanyController::class, 'add']);
Route::post('/add-company', [CompanyController::class, 'addCompany']);
Route::get('/add-product', [ProductController::class, 'add']);
Route::post('/add-product', [ProductController::class, 'addProduct']);
Route::get('/get-company/{id}', [CompanyController::class, 'getCompany']);
Route::get('/get-product/{id}', [ProductController::class, 'getProduct']);
Route::get('/company-list', [CompanyController::class, 'getAllCompanies']);
Route::get('/product-list', [ProductController::class, 'getAllProducts']);
Route::get('/ajax/get-company/{id}', [CompanyController::class, 'getCompanyAjax']);
Route::get('/ajax/get-product/{id}', [ProductController::class, 'getProductAjax']);
Route::get('/all-companies', [CompanyController::class, 'getAllCompaniesAjax']);
Route::get('/all-products', [ProductController::class, 'getAllProductsAjax']);
Route::get('/ajax/get-products', [ProductController::class, 'getAllProductsAjax']);
Route::post('/add-transaction', [TransactionController::class, 'addTransaction']);
Route::post('/save-transaction', [TransactionController::class, 'saveTransaction']);
Route::get('/all-company-products/{id}', [TransactionController::class, 'getAllTransactionsByCompany']);
Route::get('/all-product-companies/{id}', [TransactionController::class, 'getAllTransactionsByProduct']);
