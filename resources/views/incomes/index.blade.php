@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Your Income Records</h2>

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
            @forelse($incomes as $income)
                <tr>
                    <td>{{ $income->date }}</td>
                    <td>{{ $income->description }}</td>
                    <td>${{ number_format($income->amount, 2) }}</td>
                    <td>{{ $income->category }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No income records found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        {{ $incomes->links() }}
    </div>
@endsection
