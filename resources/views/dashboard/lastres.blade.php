<section>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $turkishMonth }} AYI REZERVASYONLAR</h2>
    <div class="table-responsive">
        <div class="table-responsive">
            <table class="table md:border-t-0">
                <thead class="thead">
                <tr>
                    <th>İsim</th>
                    <th>Ev</th>
                    <th>Giriş</th>
                    <th>Çıkış</th>
                    <th>Tutar</th>
                    <th>Çalışan</th>
                    <th>Notlar</th>

                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($lastReservations as $lastReservation)
                    <tr>
                        <td>{{ $lastReservation->name }}</td>
                        <td>{{ $lastReservation->house->name }}</td>
                        <td>{{ \Carbon\Carbon::create($lastReservation->start)->translatedFormat('d F') }}</td>
                        <td>{{ \Carbon\Carbon::create($lastReservation->finish)->translatedFormat('d F') }}</td>
                        <td>{{ $lastReservation->price }}</td>
                        <td>{{ $lastReservation->worker->name }}</td>
                        <td>{{ $lastReservation->info }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
