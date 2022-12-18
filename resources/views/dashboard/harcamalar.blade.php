<section>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">KİŞİYE GÖRE HARCAMALAR</h2>

    <div class="table-responsive">
        <table class="table md:border-t-0">
            <thead class="thead">
            <tr>
                <th>İsim</th>
                <th>Harcama</th>
            </tr>
            </thead>
            <tbody>
            @foreach($kisiHarcamas as $harcama)

                <tr>
                    <td>{{ $harcama[0] }}</td>
                    <td><span style="color: brown">{{ $harcama[1] }} TRY</span></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>
