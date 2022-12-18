<section>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">MESAİLER VE HUZUR HAKKI</h2>

    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Mesai ücreti') }}: {{ $mesaiUcreti }} TRY
    </h2>

    <h2 class="text-lg font-medium text-gray-900">
        {{ __('Huzur oranı') }}: %{{ $huzurOrani }}
    </h2>
    <div class="table-responsive">
        <table class="table md:border-t-0">
            <thead class="thead">
            <tr>
                <th>Kişi</th>
                <th>Mesai sayısı</th>
                <th>Mesaiden hakediş</th>
                <th>Huzur hakkı</th>
                <th>Toplam hakediş</th>
            </tr>
            </thead>
            <tbody>

            @foreach($mesais as $mesai)
                <tr>
                    <td>{{ $mesai[0] }}</td>
                    <td>{{ $mesai[1] }}</td>
                    <td>{{ round($mesai[1] * $mesaiUcreti, 2) }} TRY</td>
                    <td>{{ $mesai[2] }} TRY</td>
                    <td>{{ round(($mesai[1] * $mesaiUcreti + $mesai[2]) / 2, 2) }} TRY</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

</section>
