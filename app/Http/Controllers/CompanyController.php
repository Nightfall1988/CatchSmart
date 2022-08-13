<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CompanyService;
use \Illuminate\Support\ItemNotFoundException;

class CompanyController extends Controller
{
    private CompanyService $service;

    public function __construct(CompanyService $companyService)
    {
        $this->service = $companyService;
    }

    public function show()
    {
        return view('/company-list');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'numeric',
            'type' => 'required|max:255',
        ]);
    }

    public function add(Request $request)
    {
        return view('add-company');
    }

    public function addCompany(Request $request)
    {
        $this->store($request);
        $this->service->save($request);
        return $this->getAllCompanies();
    }

    public function getCompany(string $id)
    {
        try {
            $company = $this->service->getCompany($id);
            $products = $this->service->getCompanyProducts($id);
        } catch (ItemNotFoundException $e) {
            return view('errors/404');
        }
        return view('company-profile', ['company' => $company, 'products' => $products]);
    }

    public function getAllCompanies()
    {  
        $companies = $this->service->getAllCompanies();
        return view('company-list', ['companies' => $companies]);
    }

    public function getAllCompaniesAjax()
    {
        $companies = $this->service->getAllCompanies();
        return $companies;
    }

    public function getCompanyAjax(string $id)
    {
        try {
            $company = $this->service->getCompany($id);
        } catch (ItemNotFoundException $e) {
            return;
        };
        return $company;
    }
}
