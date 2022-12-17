<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expense') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex items-center gap-4">
                    <a href="{{ route('expenses.create') }}">
                        <x-primary-button>{{ __('Create New') }}</x-primary-button>
                    </a>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success mt-8">
                        <p>{{ $message }}</p>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table md:border-t-0">
                        <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>House</th>
                            <th>Price</th>
                            <th>User</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $expense->name }}</td>
                                <td>{{ $expense->category->name }}</td>
                                <td>{{ $expense->house->name }}</td>
                                <td>{{ $expense->price }}</td>
                                <td>{{ $expense->user->name }}</td>
                                <td>{{ $expense->created_at }}</td>

                                <td>
                                    <form action="{{ route('expenses.destroy',$expense->id) }}" method="POST">
                                        <a class="btn btn-sm btn-success"
                                           href="{{ route('expenses.edit',$expense->id) }}"><i
                                                class="fa fa-fw fa-edit"></i>
                                            Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                class="fa fa-fw fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $expenses->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
