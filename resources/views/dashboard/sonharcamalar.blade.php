<section>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $turkishMonth }} AYI SON HARCAMALARI</h2>
    <div class="table-responsive">
        <table class="table md:border-t-0">
            <thead class="thead">
            <tr>
                <th>Ev</th>
                <th>Kişi</th>
                <th>Harcama</th>
                <th>Tutar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lastExpenses as $lastExpense)

                <tr>
                    <td>{{ $lastExpense->house->name }}</td>
                    <td>{{ $lastExpense->worker->name }}</td>
                    <td>{{ $lastExpense->name }}</td>
                    <td>{{ $lastExpense->price }} TRY</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</section>
