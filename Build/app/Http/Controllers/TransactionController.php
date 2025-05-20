<?php
// app/Http/Controllers/TransactionController.php
namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $transactions = Auth::user()->transactions()->latest()->paginate(10);
        
        $totalIncome = Auth::user()->transactions()->where('type', 'income')->sum('amount');
        $totalExpense = Auth::user()->transactions()->where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;
        
        return view('transactions.index', compact('transactions', 'totalIncome', 'totalExpense', 'balance'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        Auth::user()->transactions()->create($validated);
        
        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully');
    }

    public function edit($id)
    {
        $transaction = Auth::user()->transactions()->findOrFail($id);
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $transaction = Auth::user()->transactions()->findOrFail($id);
        
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'amount' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $transaction->update($validated);
        
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
    }

    public function destroy($id)
    {
        $transaction = Auth::user()->transactions()->findOrFail($id);
        $transaction->delete();
        
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully');
    }
}