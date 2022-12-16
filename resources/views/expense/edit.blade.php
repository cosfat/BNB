<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Expense') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <section class="content container-fluid">
                        <div class="">
                            <div class="col-md-12">

                                @includeif('partials.errors')

                                <div class="card card-default">
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('expenses.update', $expense->id) }}"  role="form" enctype="multipart/form-data">
                                            {{ method_field('PATCH') }}
                                            @csrf

                                            @include('expense.form')

                                        </form>
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