<section>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">KÂR VE DOLULUK</h2>
    <div class="mt-6">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Toplam kar') }}
        </h2>
        <h4><strong><span style="color: forestgreen">{{ $bilanco -  $expenses }} TRY</span></strong></h4>
    </div>
    <div class="mt-6">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Doluluk oranları') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
        @foreach($doluluks as $doluluk)
            <h4><strong><span style="color: forestgreen">{{ $doluluk[0] }}: %{{ round(($doluluk[1] / 30)*100) }}  ({{ $doluluk[1] }} gün) </span></strong>
            </h4>
        @endforeach
    </div>
</section>
