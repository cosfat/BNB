<section>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">BUGÜN EVLERİN DURUMU: <strong>{{ \Carbon\Carbon::now()->translatedFormat('j F Y') }}</strong></h2>
    <div class="mt-6">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Dolu evler') }}
        </h2>
        @foreach($todaysStays as $todaysStay)
            <h4>{{ $todaysStay->house->name }}</h4>
        @endforeach
    </div>
    <div class="mt-6">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Bugün girişin olduğu') }}:
        </h2>
        @foreach($todaysEntrys as $todaysEntry)
            <h4>{{ $todaysEntry->house->name }}</h4>
        @endforeach
    </div>
    <div class="mt-6">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Bugün çıkışı olduğu') }}:
        </h2>
        @foreach($todaysExits as $todaysExit)
            <h4>{{ $todaysExit->house->name }}</h4>
        @endforeach
    </div>
</section>
