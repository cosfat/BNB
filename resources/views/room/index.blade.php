<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rooms') }}: {{ $house->name }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex items-center gap-4">
                    <a href="{{ route('rooms.create') }}">
                        <x-primary-button>{{ __('Create Room') }}</x-primary-button>
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

                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($rooms as $room)
                            <tr>
                                <td>{{ ++$i }}</td>

                                <td>{{ $room->name }}</td>

                                <td>
                                    <form action="{{ route('rooms.destroy',$room->id) }}" method="POST">
                                        <x-secondary-button><a href="{{ route('rooms.edit',$room->id) }}">Edit</a>
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
                </div>
                {!! $rooms->links() !!}
            </div>
        </div>
    </div>
</x-app-layout>
