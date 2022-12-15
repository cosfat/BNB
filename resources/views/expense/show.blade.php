@extends('layouts.app')

@section('template_title')
    {{ $expense->name ?? 'Show Expense' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Expense</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('expenses.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $expense->name }}
                        </div>
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $expense->price }}
                        </div>
                        <div class="form-group">
                            <strong>Category Id:</strong>
                            {{ $expense->category_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $expense->user_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
