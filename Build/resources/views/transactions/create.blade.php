@extends('layout')

@section('title', 'Add Transaction')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Add New Transaction</div>
            <div class="card-body">
                <form method="POST" action="{{ route('transactions.store') }}">
                    @csrf
                    
                    <div class="row mb-3">
                        <label for="type" class="col-md-4 col-form-label">Transaction Type</label>
                        <div class="col-md-8">
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="type" id="type-income" value="income" autocomplete="off" checked>
                                <label class="btn btn-outline-success" for="type-income">Income</label>

                                <input type="radio" class="btn-check" name="type" id="type-expense" value="expense" autocomplete="off">
                                <label class="btn btn-outline-danger" for="type-expense">Expense</label>
                            </div>
                            @error('type')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="amount" class="col-md-4 col-form-label">Amount</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" 
                                       id="amount" name="amount" value="{{ old('amount') }}" required>
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="category" class="col-md-4 col-form-label">Category</label>
                        <div class="col-md-8">
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="">Select Category</option>
                                <optgroup label="Income">
                                    <option value="Salary" {{ old('category') == 'Salary' ? 'selected' : '' }}>Salary</option>
                                    <option value="Bonus" {{ old('category') == 'Bonus' ? 'selected' : '' }}>Bonus</option>
                                    <option value="Investment" {{ old('category') == 'Investment' ? 'selected' : '' }}>Investment</option>
                                </optgroup>
                                <optgroup label="Expense">
                                    <option value="Food" {{ old('category') == 'Food' ? 'selected' : '' }}>Food</option>
                                    <option value="Transportation" {{ old('category') == 'Transportation' ? 'selected' : '' }}>Transportation</option>
                                    <option value="Housing" {{ old('category') == 'Housing' ? 'selected' : '' }}>Housing</option>
                                </optgroup>
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="date" class="col-md-4 col-form-label">Date</label>
                        <div class="col-md-8">
                            <input type="date" class="form-control @error('date') is-invalid @enderror" 
                                   id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="description" class="col-md-4 col-form-label">Description</label>
                        <div class="col-md-8">
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Save Transaction
                            </button>
                            <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection