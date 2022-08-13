@extends('layout.app')

@section('content')
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if ($errors->any())
        <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="/add-product">
            @csrf
            <label for="name">product Name:</label>
            <input type="text" id="name" name="name"><br><br>

            <label for="quantity_in_stock">product quantity:</label>
            <input type="text" id="quantity_in_stock" name="quantity_in_stock"><br><br>

            <label for="type">product type:</label>
            <input type="text" id="type" name="type"><br><br>

            <label for="price">product price:</label>
            <input type="text" id="price" name="price"><br><br>

            <button type="submit">Submit</button>
        </form>
    </div>

