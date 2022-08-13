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
        <form method="POST" action="/add-company">
            @csrf
            <label for="name">Company Name:</label>
            <input type="text" id="name" name="name"><br><br>

            <label for="address">Company address:</label>
            <input type="text" id="address" name="address"><br><br>

            <label for="type">Company type:</label>
            <input type="text" id="type" name="type"><br><br>

            <label for="phone">Company Phone:</label>
            <input type="text" id="phone" name="phone"><br><br>

            <button type="submit">Submit</button>
        </form>
    </div>

