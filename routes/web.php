<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// routes/web.php

// ... other routes ...

// Grouping routes that need authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/incomes', [\App\Http\Controllers\IncomeController::class, 'index']);
    Route::get('/expenses', [\App\Http\Controllers\ExpenseController::class, 'index']);
    Route::get('/incomes/create', [\App\Http\Controllers\IncomeController::class, 'create'])->name('incomes.create');
    Route::post('/incomes/store', [\App\Http\Controllers\IncomeController::class, 'store'])->name('incomes.store');
    Route::get('/incomes/index', [\App\Http\Controllers\IncomeController::class, 'index'])->name('incomes.index');
    Route::get('/incomes/edit', [\App\Http\Controllers\IncomeController::class, 'edit'])->name('incomes.edit');
    Route::delete('/incomes/{income}', [\App\Http\Controllers\IncomeController::class, 'destroy'])->name('incomes.destroy');
    Route::get('/expenses', [\App\Http\Controllers\ExpenseController::class, 'index']);
    Route::get('/expenses/create', [\App\Http\Controllers\ExpenseController::class, 'create'])->name('expenses.create');
    Route::post('/expenses/store', [\App\Http\Controllers\ExpenseController::class, 'store'])->name('expenses.store');
    Route::get('/expenses/index', [\App\Http\Controllers\ExpenseController::class, 'index'])->name('expenses.index');
    Route::get('/expenses/edit', [\App\Http\Controllers\ExpenseController::class, 'edit'])->name('expenses.edit');
    Route::delete('/expenses/{income}', [\App\Http\Controllers\ExpenseController::class, 'destroy'])->name('expenses.destroy');

    // ... other routes related to incomes and expenses ...
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*Route::middleware(['auth'])->group(function () {
    Route::resource('incomes', 'IncomeController');
    Route::resource('expenses', 'ExpenseController');
});*/
//Route::view('/incomes', 'welcome');

Route::get('/incomes', [\App\Http\Controllers\IncomeController::class, 'index']);
