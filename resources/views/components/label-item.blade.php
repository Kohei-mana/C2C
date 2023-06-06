@props(['value'])

<label {{ $attributes->merge(['class' => 'block border-bottom font-medium text-m text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>

