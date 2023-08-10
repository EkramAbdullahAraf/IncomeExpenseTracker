@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Your Income Records</h2>

        <!-- Total Income Display -->
        <h4 class="mb-4">Total Income: ${{ number_format($totalIncome, 2) }}</h4>

        <!-- Add Income Button -->
        <a href="{{ route('incomes.create') }}" class="btn btn-primary mb-3">Add Income</a>

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
            @forelse($incomes as $income)
                <tr>
                    <td>{{ $income->date }}</td>
                    <td>{{ $income->description }}</td>
                    <td>${{ number_format($income->amount, 2) }}</td>
                    <td>{{ $income->category }}</td>
                    <td>
                        <a href="{{ route('incomes.edit', $income->id) }}" class="btn btn-secondary">Edit</a>
                    </td>
                    <td>
                        <form action="{{ route('incomes.destroy', $income->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No income records found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <!-- Pagination Links -->
        {{ $incomes->links() }}
    </div>
@endsection
