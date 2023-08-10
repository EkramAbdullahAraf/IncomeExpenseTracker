@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Your Expense Records</h2>

        <!-- Total Expense Display -->
        <h4 class="mb-4">Total Expense: ${{ number_format($totalExpense, 2) }}</h4>

        <!-- Add Expense Button -->
        <a href="{{ route('expenses.create') }}" class="btn btn-primary mb-3">Add Expense</a>

        <table class="table">
            <thead>
            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Amount</th>
                <th>Category</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @forelse($expenses as $expense)
                <tr>
                    <td>{{ $expense->date }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>${{ number_format($expense->amount, 2) }}</td>
                    <td>{{ $expense->category }}</td>
                    <td>
                        <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-secondary">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('expenses.destroy', $expense->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No expense records found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        {{ $expenses->links() }}
    </div>
@endsection
