<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hoşgeldin')  }} {{ Auth::user()->name }}!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('dashboard.summary')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    ;// Hesaplaşma bölümü
                    Toplam harcama, zaferin - fatihin harcaması, aradaki fark
                    Mesai sayısı katsayısı ve toplam miktarı
                    Huzur hakkı bedeli
                    Alacak verecek son durumu
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
