@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add New Expense</h2>

        <form action="{{ route('expenses.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" step="0.01" name="amount" class="form-control" id="amount" value="{{ old('amount') }}">
                @error('amount')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" name="description" class="form-control" id="description" value="{{ old('description') }}">
                @error('description')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" name="date" class="form-control" id="date" value="{{ old('date') }}">
                @error('date')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" name="category" class="form-control" id="category" value="{{ old('category') }}">
                @error('category')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Add Expense</button>
        </form>
    </div>
@endsection
