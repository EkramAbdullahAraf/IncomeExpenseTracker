@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Your Expense Records</h2>

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
            @forelse($expenses as $expense)
                <tr>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>${{ number_format($expense->amount, 2) }}</td>
                    <td>{{ $expense->category }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No expense records found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        {{ $expenses->links() }}
    </div>
@endsection
