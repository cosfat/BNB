<div>
    <x-input-label for="name" :value="__('Category name')" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" placeholder="{{ $category->name }}" value="{{ $category->name }}" />
    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="flex items-center gap-4">
    <x-primary-button>{{ __('Save') }}</x-primary-button>
</div>
