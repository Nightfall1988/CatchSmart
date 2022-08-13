@extends('layout.app')

@section('content')
<div id='container'>
    <input name='company_id' type="hidden" value={{ $company->id }}/>
    
    <div>
        <h1>{{ $company->name}} Profile</h1>
    </div>
    
    <div>
        <p>Type: <b>{{ $company->type}}</b></p>
        <p>Address: <b>{{ $company->address}}</b></p>
        <p>Phone: <b>{{ $company->phone}}</b></p>
    </div>

    @if (!$products->isNotEmpty())
        <p>There are no products listed for this company</p>
    @endif

    <div id='app'>       
        <add-transaction-from-company v-bind:company_id={{ $company->id }}>
        </add-transaction-from-company>
        <br>
    </div>
</div>