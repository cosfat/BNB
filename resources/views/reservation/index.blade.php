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
                            <th>Name</th>
                            <th>House</th>
                            <th>Start</th>
                            <th>Finish</th>
                            <th>Price</th>
                            <th>Worker</th>
                            <th>Info</th>

                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->name }}</td>
                                <td>{{ $reservation->house->name }}</td>
                                <td>{{ $reservation->start }}</td>
                                <td>{{ $reservation->finish }}</td>
                                <td>{{ $reservation->price }}</td>
                                <td>{{ $reservation->worker->name }}</td>
                                <td style="max-width: 100px">{{ $reservation->info }}</td>

                                <td>
                                    <form action="{{ route('reservations.destroy',$reservation->id) }}"
                                          method="POST">
                                        <x-secondary-button><a href="{{ route('reservations.edit',$reservation->id) }}">Edit</a>
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
                    {!! $reservations->links() !!}
                </div>
            </div>
        </div>
</x-app-layout>
