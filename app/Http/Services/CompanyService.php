<?php

namespace App\Http\Services;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;

class CompanyService 
{
    private Company $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function save(Request $request)
    {
        $this->company = Company::firstOrCreate([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'type' => $request->type,
        ]);

        return $this->company;
    }
    
    public function getAllCompanies(): Collection
    {
        $companies = Company::all();
        return $companies;
    }

    public function getCompany(string $id): Company
    {
        return Company::where('id', $id)->get()->firstOrFail();
    }

    public function getCompanyProducts(string $id): Collection
    {
        return Company::with('products')->find($id)->products;
    }
}