@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Incomes</h2>

        <table class="table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Category</th>
            </tr>
            </thead>
            <tbody>
            @foreach($incomes as $income)
                <tr>
                    <td>{{ $income->date }}</td>
                    <td>{{ $income->description }}</td>
                    <td>${{ number_format($income->amount, 2) }}</td>
                    <td>{{ $income->category }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        {{ $incomes->links() }}
    </div>
@endsection
