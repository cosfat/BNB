<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Rezervasyonlar: {{ $turkishMonth }} Ayı
        </h2>
        <select id="houses" class="mt-1 block w-full" name="c">
            <option value="10">Tüm evler</option>
            @foreach($houses as $house)
                <option name="houses" @if($c == $house->id) selected @endif value="{{ $house->id }}">{{ $house->name }}</option>
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
                    <a href="{{ route('reservations.create') }}">
                        <x-primary-button>{{ __('Create Reservation') }}</x-primary-button>
                    </a>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success mt-8">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <h2 class="text-lg font-medium text-gray-900 mt-4">
                    Toplam: <strong>{{ $resSum }} TRY</strong>
                </h2>
                <div class="table-responsive">
                    <table class="table md:border-t-0">
                        <thead class="thead">
                        <tr>
                            <th>İsim</th>
                            <th>Ev</th>
                            <th>Giriş</th>
                            <th>Çıkış</th>
                            <th>Tutar</th>
                            <th>Mesai</th>
                            <th>Notlar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{ $reservation->name }}</td>
                                <td>{{ $reservation->house->name }}</td>
                                <td>{{ \Carbon\Carbon::create($reservation->start)->translatedFormat('d F') }}</td>
                                <td>{{ \Carbon\Carbon::create($reservation->finish)->translatedFormat('d F') }}</td>
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
    </div>
        <script>
            $("#houses").change(function (){
                var c = document.getElementById("houses").value;
                location.href="/reservations?m={{ $month }}&y={{ $year }}&c="+c;
            })</script>
</x-app-layout>
