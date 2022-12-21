<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('GİDERLER') }}: {{ $turkishMonth }} Ayı
        </h2>
        <select id="categories" class="mt-1 block w-full" name="c">
            <option value="10">Tüm giderler</option>
            @foreach($categories as $category)
                <option name="categories" @if($c == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <div class="mt-2">
            <x-primary-button><a href="?m={{ $oncekiAy->format('m') }}&y={{ $oncekiAy->format('Y') }}&c={{ $c }}"><- Önceki
                    ay</a></x-primary-button>
            <div class="float-right">
                <x-primary-button><a href="?m={{ $sonrakiAy->format('m') }}&y={{ $sonrakiAy->format('Y') }}&c={{ $c }}">Sonraki
                        ay -></a></x-primary-button>
            </div>
        </div>
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
                <h2 class="text-lg font-medium text-gray-900 mt-4">
                    Toplam: <strong>{{ $expenseSum }} TRY</strong>
                </h2>
                <div class="table-responsive">
                    <table class="table md:border-t-0">
                        <thead class="thead">
                        <tr>
                            <th>No</th>
                            <th>Gider</th>
                            <th>Kategori</th>
                            <th>Ev</th>
                            <th>Tutar</th>
                            <th>Ödeyen</th>
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
                                <td>{{ $expense->worker->name }}</td>
                                <td>{{ \Carbon\Carbon::create($expense->created_at)->translatedFormat('d F') }}</td>

                                <td>
                                    <form action="{{ route('expenses.destroy',$expense->id) }}" method="POST">
                                        <x-secondary-button><a href="{{ route('expenses.edit',$expense->id) }}">Edit</a>
                                        </x-secondary-button>
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button>Delete</x-danger-button>
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
    <script>
        $("#categories").change(function (){
            var c = document.getElementById("categories").value;
           location.href="/expenses?m={{ $month }}&y={{ $year }}&c="+c;
        })
    </script>
</x-app-layout>
