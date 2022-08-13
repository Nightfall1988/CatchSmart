
@extends('layout.app')

@section('content')
<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    <h1>Welcome to your App</h1>
    <div id='navigation'>
        <div><a class="navigation-button" style="text-decoration: none;" href='/add-company'>Add Company</a></div>
        <div><a class="navigation-button" style="text-decoration: none;" href='/add-product'>Add Product</a></div>
        <div><a class="navigation-button" style="text-decoration: none;" href='/company-list'>Company List</a></div>
        <div><a class="navigation-button" style="text-decoration: none;" href='/product-list'>Product List</a></div>
    </div>
</div>
