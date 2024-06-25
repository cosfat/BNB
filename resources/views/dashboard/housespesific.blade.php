<section>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">EVLERE GÖRE GİDERLER VE CİROLAR</h2>
    <div class="table-responsive">
        <table class="table md:border-t-0">
            <thead class="thead">
            <tr>
                <th>Ev</th>
                <th>Harcama</th>
            </tr>
            </thead>
            <tbody>
            @foreach($harcamas as $harcama)

                <tr>
                    <td>{{ $harcama[0] }}</td>
                    <td><span style="color: brown">{{ $harcama[1] }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table md:border-t-0">
            <thead class="thead">
            <tr>
                <th>Ev</th>
                <th>Ciro</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bilancos as $bilanco)
                <tr>
                    <td>{{ $bilanco[0] }}</td>
                    <td><span style="color: forestgreen">{{ $bilanco[1] }}</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table md:border-t-0">
            <thead class="thead">
            <tr>
                <th>Ev</th>
                <th>Kâr</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bilancos as $bilanco)
                @foreach($harcamas as $harcama)
                    @if($harcama[0] == $bilanco[0])
                        <tr>
                            <td>{{ $harcama[0] }}</td>
                            <td><span style="color: forestgreen">{{ $bilanco[1] - $harcama[1] }}</span></td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
</section>
