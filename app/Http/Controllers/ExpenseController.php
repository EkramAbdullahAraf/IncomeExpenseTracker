<?php

namespace App\Http\Controllers;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {

        // Fetching expense records with optional filtering
        $expenses = auth()->user()->expenses();

        // Filtering by categories
        if ($request->has('category')) {
            $expenses->where('category', $request->category);
        }

        // Filtering by date range
        if ($request->has('from_date') && $request->has('to_date')) {
            $expenses->whereBetween('date', [$request->from_date, $request->to_date]);
        }

        // Sorting
        if ($request->has('sort_by')) {
            $sortOrder = $request->input('order', 'asc');
            $expenses->orderBy($request->sort_by, $sortOrder);
        }

        // Fetch total expense and expenses
        $totalExpense = $expenses->sum('amount');
        $totalExpenses = auth()->user()->expenses()->sum('amount');
        $netExpense = $totalExpense - $totalExpenses;

        // Paginate the result
        $expenses = $expenses->paginate(10);

        return view('expenses.index', compact('expenses', 'totalExpense', 'netExpense'));
    }

    public function edit(Expense $expense)
    {
        // Authorization check
        $this->authorize('update', $expense);

        return view('expenses.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        // Authorization check
        $this->authorize('update', $expense);



        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'category' => 'nullable|string|max:255'
        ]);


        $request->user()->expenses()->create($validatedData);

        return redirect()->route('expenses.index')->with('success', 'Expense added successfully');
    }
    public function create()
    {
        return view('expenses.create');
    }

    public function destroy(Expense $expense)
    {
        // Authorization check
        $this->authorize('delete', $expense);

        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully');
    }
}
