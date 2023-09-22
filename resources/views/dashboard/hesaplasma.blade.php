<section>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">HESAPLAŞMA</h2>

    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Hesaplaşma ücreti') }}: {{ $hesaplasma }} TRY
    </h2>

    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Kişi başı') }}: {{ round($hesaplasma / 2, 2)}} TRY
    </h2>

    <h2 class="text-lg font-medium text-gray-900">
        {{ __('EUR tahmini') }}: {{ round(($hesaplasma / 2)/28.4, 2)}}€
    </h2>

    <h2 class="text-lg font-medium text-gray-900">
        Mesai, huzur ve harcama farkı sonrası alacak verecek: <strong>{{ $huzurMesaiveHarcamaFarki }}</strong>
    </h2>
</section>
