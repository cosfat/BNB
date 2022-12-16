<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $expense->name ?? 'Show Expense' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="content container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
