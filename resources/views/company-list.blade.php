@extends('layout.app')

@section('content')
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="flex justify-center space-x-1.5">
            <a href='/add-company'>Add another company</a>

            <table>
                <tr class="table-row space-x-0.5">
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                </tr>
        @foreach ($companies->all() as $company)
        <tr class="border-solid border-2 border-blue-800">
            <td class="border-solid border-2 border-blue-800">{{ $company->name }}</td>
            <td class="border-solid border-2 border-blue-800">{{ $company->address }}</td>
            <td class="border-solid border-2 border-blue-800">{{ $company->phone }}</td>
            <td class="border-solid border-2 border-blue-800"><a href="/get-company/{{ $company->id }}">Profile</a></td>
        @endforeach
        </table>
    </div>
