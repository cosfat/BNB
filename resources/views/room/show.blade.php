<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $room->name ?? 'Show Room' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="float-right">
                    <a class="btn btn-primary" href="{{ route('rooms.index') }}"> Back</a>
                </div>
            </div>

            <div class="card-body">

                <div class="form-group">
                    <strong>Name:</strong>
                    {{ $room->name }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
