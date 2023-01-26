<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div>
    <x-input-label for="name" :value="__('Designer object')"/>
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ $designer->name }}"
                  value="{{ $designer->name }}"/>
    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div>
    <x-input-label for="house_id" :value="__('House name')"/>
    <select name="house_id" id="house_id" class="mt-1 block w-full">
        @foreach ($houses as $house)
            <option @if($designer->house_id == $house->id) selected
                    @endif value="{{ $house->id }}">{{ $house->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('house_id', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div>
    <x-input-label for="worker_id" :value="__('Ödeyen')"/>
    <select name="worker_id" id="worker_id" class="mt-1 block w-full">
        @foreach ($workers as $worker)
            <option @if($designer->worker_id == $worker->id) selected
                    @endif value="{{ $worker->id }}">{{ $worker->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('worker_id', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div>
    <x-input-label for="price" :value="__('Price')"/>
    <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" value="{{ $designer->price }}"
                  value="{{ $designer->price }}"/>
    {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div>
    <x-input-label for="taksit" :value="__('Taksit sayısı')"/>
    <x-text-input id="taksit" name="taksit" type="text" class="mt-1 block w-full" value="{{ $designer->taksit }}"
                  value="{{ $designer->taksit }}"/>
    {!! $errors->first('taksit', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div>
    <x-input-label for="kargo" :value="__('Kargo firması')"/>
    <x-text-input id="kargo" name="kargo" type="text" class="mt-1 block w-full" value="{{ $designer->kargo }}"
                  value="{{ $designer->kargo }}"/>
    {!! $errors->first('kargo', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div>
    <x-input-label for="verilis" :value="__('Veriliş')"/>
    <x-text-input id="datepicker1" name="verilis" type="text" class="mt-1 block w-full" autocomplete="off"
                  value="{{ $designer->verilis }}"></x-text-input>
    {!! $errors->first('verilis', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div>
    <x-input-label for="teslimat" :value="__('Teslimat')"/>
    <x-text-input id="datepicker2" name="teslimat" type="text" class="mt-1 block w-full" autocomplete="off"
                  value="{{ $designer->teslimat }}"></x-text-input>
    {!! $errors->first('teslimat', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div>
    <x-input-label for="detay" :value="__('Detay')"/>
    <x-text-input id="detay" name="detay" type="text" class="mt-1 block w-full" value="{{ $designer->detay }}"
                  value="{{ $designer->detay }}"/>
    {!! $errors->first('detay', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div>
    <x-input-label for="link" :value="__('Link')"/>
    <x-text-input id="link" name="link" type="text" class="mt-1 block w-full" value="{{ $designer->link }}"
                  value="{{ $designer->link }}"/>
    {!! $errors->first('link', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div>
    <x-input-label for="completed" :value="__('Alındı mı?')"/>
    <select name="completed" id="completed" class="mt-1 block w-full">

        <option value=1 @if($designer->completed == 1) selected @endif>Evet</option>
        <option value=0 @if($designer->completed == 0) selected @endif>Hayır</option>
    </select>
    {!! $errors->first('completed', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="flex items-center gap-4">
    <x-primary-button>{{ __('Save') }}</x-primary-button>
</div>

<script>
    $(document).ready(function () {
        $("#datepicker1").datepicker({
            // Set the date format to "dd/mm/yy"
            dateFormat: "yy/mm/dd",
            // Set the language to Turkish
            regional: "tr",
            // Set the background color of the calendar
            beforeShow: function (input, inst) {
                inst.dpDiv.css({
                    "background": "green",
                    "color": "white",
                    "padding": "5px"
                });
            }
        });

        $("#datepicker2").datepicker({
            // Set the date format to "dd/mm/yy"
            dateFormat: "yy/mm/dd",
            // Set the language to Turkish
            regional: "tr",
            // Set the background color of the calendar
            beforeShow: function (input, inst) {
                inst.dpDiv.css({
                    "background": "red",
                    "color": "white",
                    "padding": "5px"
                });
            }
        });
    });
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
