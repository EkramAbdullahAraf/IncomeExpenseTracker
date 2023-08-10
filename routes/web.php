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
    Route::get('/incomes', 'IncomeController@index');
    Route::get('/expenses', 'ExpenseController@index');
    // ... other routes related to incomes and expenses ...
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {
    Route::resource('incomes', 'IncomeController');
    Route::resource('expenses', 'ExpenseController');
});
