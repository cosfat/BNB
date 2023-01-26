<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Yeni Ev Tasarımı
        </h2>

        <select id="houses" class="mt-1 block w-full" name="c">
            <option value="10">Tüm evler</option>
            @foreach($houses as $house)
                <option name="houses" @if($c == $house->id) selected
                        @endif value="{{ $house->id }}">{{ $house->name }}</option>
            @endforeach
        </select>

        <div class="flex items-center gap-4 mt-4">
            <a href="/designers?completed=3&c={{ $c }}">
                <x-primary-button>{{ __('Tüm objeler') }}</x-primary-button>
            </a>

            <a href="/designers?completed=0&c={{ $c }}">
                <x-danger-button>{{ __('Satın alınacaklar') }}</x-danger-button>
            </a>

            <a href="/designers?completed=1&c={{ $c }}">
                <x-secondary-button>{{ __('Satın alınmışlar') }}</x-secondary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex items-center gap-4">
                    <a href="{{ route('designers.create') }}">
                        <x-primary-button>{{ __('Create Design Object') }}</x-primary-button>
                    </a>
                </div>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success mt-8">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <h2 class="text-lg font-medium text-gray-900 mt-4">
                    Toplam: <strong>{{ $desSum }} TRY</strong>
                </h2>
                <div class="table-responsive">
                    <table class="table md:border-t-0">
                        <thead class="thead">
                        <tr>
                            <th>Obje</th>
                            <th>Ev</th>
                            <th>Tutar</th>
                            <th>Ödeyen</th>
                            <th>Taksit Sayısı</th>
                            <th>Taksit tutarı</th>
                            <th>Kargo</th>
                            <th>Veriliş</th>
                            <th>Teslim</th>
                            <th>Link</th>
                            <th>Satın alındı mı?</th>
                            <th>Detay</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($designers as $designer)
                            <tr>
                                <td>{{ $designer->name }}</td>
                                <td>{{ $designer->house->name }}</td>
                                <td>{{ $designer->price }}</td>
                                <td>{{ $designer->worker->name }}</td>
                                <td>{{ $designer->taksit }}</td>
                                <td>{{ round($designer->price / $designer->taksit, 2) }}</td>
                                <td>{{ $designer->kargo }}</td>
                                <td>{{ \Carbon\Carbon::create($designer->verilis)->translatedFormat('d F') }}</td>
                                <td>{{ \Carbon\Carbon::create($designer->teslimat)->translatedFormat('d F') }}</td>
                                <td>@if($designer->link != null)
                                        <a style="color: #2d3748" target="_blank"
                                           href="{{ $designer->link }}">{{ substr($designer->link, 11, 15) }}</a>
                                    @endif</td>
                                <td>@if($designer->completed == 1)
                                        Evet
                                    @else
                                        Hayır
                                    @endif</td>
                                <td>{{ $designer->detay }}</td>
                                <td>
                                    <form action="{{ route('designers.destroy',$designer->id) }}"
                                          method="POST">
                                        <x-secondary-button><a
                                                href="{{ route('designers.edit',$designer->id) }}">Edit</a>
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
                    {!! $designers->links() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#houses").change(function () {
            var c = document.getElementById("houses").value;
            location.href = "/designers?c=" + c;
        })</script>

</x-app-layout>
