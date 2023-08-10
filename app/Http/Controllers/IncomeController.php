<?php

namespace App\Http\Controllers;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index(Request $request)
    {

        // Fetching income records with optional filtering
        $incomes = auth()->user()->incomes();

        // Filtering by categories
        if ($request->has('category')) {
            $incomes->where('category', $request->category);
        }

        // Filtering by date range
        if ($request->has('from_date') && $request->has('to_date')) {
            $incomes->whereBetween('date', [$request->from_date, $request->to_date]);
        }

        // Sorting
        if ($request->has('sort_by')) {
            $sortOrder = $request->input('order', 'asc');
            $incomes->orderBy($request->sort_by, $sortOrder);
        }

        // Fetch total income and expenses
        $totalIncome = $incomes->sum('amount');
        $totalExpenses = auth()->user()->expenses()->sum('amount');
        $netIncome = $totalIncome - $totalExpenses;

        // Paginate the result
        $incomes = $incomes->paginate(10);

        return view('incomes.index', compact('incomes', 'totalIncome', 'netIncome'));
    }

    public function edit(Income $income)
    {
        // Authorization check
        $this->authorize('update', $income);

        return view('incomes.edit', compact('income'));
    }

    public function update(Request $request, Income $income)
    {
        // Authorization check
        $this->authorize('update', $income);



        return redirect()->route('incomes.index')->with('success', 'Income updated successfully');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:255',
            'date' => 'required|date',
            'category' => 'nullable|string|max:255'
        ]);


       $request->user()->incomes()->create($validatedData);

        return redirect()->route('incomes.index')->with('success', 'Income added successfully');
    }
    public function create()
    {
        return view('incomes.create');
    }

    public function destroy(Income $income)
    {
        // Authorization check
        $this->authorize('delete', $income);

        $income->delete();
        return redirect()->route('incomes.index')->with('success', 'Income deleted successfully');
    }
}
