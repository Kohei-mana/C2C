<x-guest-layout>
    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <x-input-label for="email" :value="__('Email')" />
        <x-label-item id="email" class="block mt-1 w-full" value="{{ $email }}" />
        <x-input-label for="name" :value="__('Name')" />
        <x-label-item id="name" class="block mt-1 w-full" value="{{ $name }}" />
        <x-input-label for="postal_code" :value="__('Postal Code')" />
        <x-label-item id="postal_code" class="block mt-1 w-full" value="{{ $postal_code }}" />
        <x-input-label for="address" :value="__('Address')" />
        <x-label-item id="address" class="block mt-1 w-full" value="{{ $address }}" />

        <div class="flex items-center justify-end mt-4">
            <x-secondary-button class="ml-4">
            { __('BACK') }}
            </x-secondary-button>
            <x-primary-button class="ml-4">
                {{ __('REGISTER') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
