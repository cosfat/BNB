<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expense') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">

                                            <div class="float-right">
                                                <a href="{{ route('expenses.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                                    {{ __('Create New') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead class="thead">
                                                <tr>
                                                    <th>No</th>

                                                    <th>Name</th>
                                                    <th>Price</th>
                                                    <th>Category Id</th>
                                                    <th>User Id</th>

                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($expenses as $expense)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>

                                                        <td>{{ $expense->name }}</td>
                                                        <td>{{ $expense->price }}</td>
                                                        <td>{{ $expense->house_id }}</td>
                                                        <td>{{ $expense->category_id }}</td>
                                                        <td>{{ $expense->user_id }}</td>
                                                        <td>{{ $expense->created_at }}</td>

                                                        <td>
                                                            <form action="{{ route('expenses.destroy',$expense->id) }}" method="POST">
                                                                <a class="btn btn-sm btn-primary " href="{{ route('expenses.show',$expense->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                                <a class="btn btn-sm btn-success" href="{{ route('expenses.edit',$expense->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {!! $expenses->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
