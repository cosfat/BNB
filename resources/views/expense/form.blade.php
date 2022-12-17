
<div>
<x-input-label for="name" :value="__('Expense name')" />
<x-text-input id="name" name="name" type="text" class="mt-1 block w-full" placeholder="{{ $expense->name }}" value="{{ $expense->name }}" />
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div>

<x-input-label for="name" :value="__('Price')" />
<x-text-input id="price" name="price" type="text" class="mt-1 block w-full" placeholder="{{ $expense->price }}" value="{{ $expense->price }}" />
            {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}

</div>
<div>
    <x-input-label for="house_id" :value="__('House')" />
    <select id="house_id" name="house_id" class="mt-1 block w-full"  />
                @foreach ($houses as $house)
                    <option @if($expense->house_id == $house->id) selected @endif  value="{{ $house->id }}">{{ $house->name }}</option>
                @endforeach
</select>

        {!! $errors->first('house_id', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div>
    <x-input-label for="category_id" :value="__('Category')" />
            <select name="category_id" id="category_id" class="mt-1 block w-full">
                @foreach ($categories as $category)
                    <option @if($expense->category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('category_id', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div>
<x-input-label for="user_id" :value="__('User')" />
            <select name="user_id" id="user_id" class="mt-1 block w-full">
                @foreach ($users as $user)
                    <option @if($expense->user_id == $user->id) selected @endif  value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
</div>
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </div>
