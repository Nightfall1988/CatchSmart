@extends('layout.app')

@section('content')

<body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="flex justify-center space-x-1.5">
            <a href='/add-product'>Add another product</a>
            <table>
                <tr class="table-row space-x-0.5">
                    <th>Name</th>
                    <th>type</th>
                    <th>price</th>
                </tr>
        @foreach ($products->all() as $product)
        <tr class="border-solid border-2 border-blue-800">
            <td class="border-solid border-2 border-blue-800">{{ $product->name }}</td>
            <td class="border-solid border-2 border-blue-800">{{ $product->type }}</td>
            <td class="border-solid border-2 border-blue-800">{{ $product->price }}</td>
            <td class="border-solid border-2 border-blue-800"><a href="/get-product/{{ $product->id }}">Profile</a></td>
        @endforeach
        </table>
    </div>
</body>

</html>
