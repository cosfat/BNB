<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<div>
    <x-input-label for="name" :value="__('Reservation name')"/>
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ $reservation->name }}"
                  value="{{ $reservation->name }}"/>
    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div>
    <x-input-label for="house_id" :value="__('House name')"/>
    <select name="house_id" id="house_id" class="mt-1 block w-full">
        @foreach ($houses as $house)
            <option @if($reservation->house_id == $house->id) selected
                    @endif value="{{ $house->id }}">{{ $house->name }}</option>
        @endforeach
    </select>
    {!! $errors->first('house_id', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div>
    <x-input-label for="start" :value="__('Start')"/>
    <x-text-input id="datepicker1" name="start" type="text" class="mt-1 block w-full"
                  value="{{ $reservation->start }}"></x-text-input>
    {!! $errors->first('start', '<div class="invalid-feedback">:message</div>') !!}
</div>

<div>
    <x-input-label for="finish" :value="__('Finish')"/>
    <x-text-input id="datepicker2" name="finish" type="text" class="mt-1 block w-full"
                  value="{{ $reservation->finish }}"></x-text-input>
    {!! $errors->first('finish', '<div class="invalid-feedback">:message</div>') !!}
</div>


<div>
    <x-input-label for="price" :value="__('Price')"/>
    <x-text-input id="price" name="price" type="text" class="mt-1 block w-full" value="{{ $reservation->price }}"
                  value="{{ $reservation->price }}"/>
    {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
</div>


<div>
    <x-input-label for="info" :value="__('Info')"/>
    <x-text-input id="info" name="info" type="text" class="mt-1 block w-full" value="{{ $reservation->info }}"
                  value="{{ $reservation->info }}"/>
    {!! $errors->first('info', '<div class="invalid-feedback">:message</div>') !!}
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
