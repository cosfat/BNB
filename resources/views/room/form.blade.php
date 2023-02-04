<div>
    <div>
        <x-input-label for="house_id" :value="__('House')"/>
        <select id="house_id" name="house_id" class="mt-1 block w-full"/>
        @foreach ($houses as $house)
            <option @if($room->house_id == $house->id) selected
                    @endif  value="{{ $house->id }}">{{ $house->name }}</option>
            @endforeach
            </select>
    </div>
    <x-input-label for="name" :value="__('Room name')"/>
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" placeholder="{{ $room->name }}"
                  value="{{ $room->name }}"/>
    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="flex items-center gap-4">
    <x-primary-button>{{ __('Save') }}</x-primary-button>
</div>
