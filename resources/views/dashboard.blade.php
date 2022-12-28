<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            HOŞGELDİN

            <h2 class="text-lg font-medium text-gray-900 mt-2">
                <strong>{{ $turkishMonth }}</strong> ayı özetini görüntülüyorsun
            </h2>
            <div class="mt-2">
                <x-primary-button><a href="?m={{ $oncekiAy->format('m') }}&y={{ $oncekiAy->format('Y') }}"><- Önceki
                        ay</a></x-primary-button>

                <div class="float-right">
                    <x-primary-button><a href="?m={{ $sonrakiAy->format('m') }}&y={{ $sonrakiAy->format('Y') }}">Sonraki
                            ay -></a></x-primary-button>
                </div>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('dashboard.today')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('dashboard.summary')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('dashboard.housespesific')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('dashboard.mesais')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('dashboard.harcamalar')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('dashboard.hesaplasma')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('dashboard.sonharcamalar')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('dashboard.lastres')
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
