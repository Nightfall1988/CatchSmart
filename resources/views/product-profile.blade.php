@extends('layout.app')

@section('content')
<div id='container'>
    <input name='product_id' type="hidden" value={{ $product->id }}/>

    <div>
        <h1>{{ $product->name}} Profile</h1>
    </div>

    <div>
        <p>Type: <b>{{ $product->type}}</b></p>
        <p>Quantity: <b>{{ $product->quantity_in_stock}}</b></p>
        <p>Price: €<b>{{ $product->price}}</b></p>
    </div>
    
    @if (!$companies->isNotEmpty())
        <p>There are no companies listed for this product</p>
    @endif

    <div id="app">
        <add-transaction-from-product v-bind:product_id={{ $product->id }}>
        </add-transaction-from-product>
    </div>
</div>
