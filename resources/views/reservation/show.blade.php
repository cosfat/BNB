<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $reservation->name ?? 'Show Reservation' }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex items-center gap-4">
                    <div class="card-body">
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $reservation->name }}
                        </div>
                        <div class="form-group">
                            <strong>Start:</strong>
                            {{ $reservation->start }}
                        </div>
                        <div class="form-group">
                            <strong>Finish:</strong>
                            {{ $reservation->finish }}
                        </div>
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $reservation->price }}
                        </div>
                        <div class="form-group">
                            <strong>Info:</strong>
                            {{ $reservation->info }}
                        </div>
                    </div>
                </div>
                <div class="card-header">
                    <a class="btn btn-primary" href="{{ route('reservations.index') }}">
                        <x-primary-button>Back</x-primary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
