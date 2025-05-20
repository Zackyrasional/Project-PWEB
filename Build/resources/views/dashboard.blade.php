@extends('layout')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Welcome, {{ auth()->user()->name }}</h2>
        <p>This is your personal dashboard.</p>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Income</h5>
                        <p class="card-text h4">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                        <a href="{{ route('transactions.index', ['type' => 'income']) }}" class="text-white">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Expense</h5>
                        <p class="card-text h4">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                        <a href="{{ route('transactions.index', ['type' => 'expense']) }}" class="text-white">View Details</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Current Balance</h5>
                        <p class="card-text h4">Rp {{ number_format($balance, 0, ',', '.') }}</p>
                        <a href="{{ route('transactions.index') }}" class="text-white">View All Transactions</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mt-4">
            <div class="card-header">
                <h5>Recent Transactions</h5>
            </div>
            <div class="card-body">
                @if($recentTransactions->count() > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentTransactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->date->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $transaction->type === 'income' ? 'success' : 'danger' }}">
                                            {{ ucfirst($transaction->type) }}
                                        </span>
                                    </td>
                                    <td>{{ $transaction->category }}</td>
                                    <td class="{{ $transaction->type === 'income' ? 'text-success' : 'text-danger' }}">
                                        Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                    </td>
                                    <td>{{ $transaction->description ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('transactions.index') }}" class="btn btn-primary">View All Transactions</a>
                @else
                    <p>No transactions yet. <a href="{{ route('transactions.create') }}">Add your first transaction</a></p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection