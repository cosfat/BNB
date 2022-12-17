<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservations') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex items-center gap-4">
                    <a href="{{ route('reservations.create') }}">
                        <x-primary-button>{{ __('Create Reservation') }}</x-primary-button>
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
                            <th>Start</th>
                            <th>Finish</th>
                            <th>Price</th>
                            <th>Info</th>

                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{ ++$i }}</td>

                                <td>{{ $reservation->name }}</td>
                                <td>{{ $reservation->start }}</td>
                                <td>{{ $reservation->finish }}</td>
                                <td>{{ $reservation->price }}</td>
                                <td>{{ $reservation->info }}</td>

                                <td>
                                    <form action="{{ route('reservations.destroy',$reservation->id) }}"
                                          method="POST">
                                        <a class="btn btn-sm btn-success"
                                           href="{{ route('reservations.edit',$reservation->id) }}"><i
                                                class="fa fa-fw fa-edit"></i> Edit</a>
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
                </div>
            </div>
        </div>
    {!! $reservations->links() !!}
</x-app-layout>
