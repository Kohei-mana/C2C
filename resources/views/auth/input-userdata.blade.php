<x-guest-layout>
    <form method="POST" action="{{ route('register.confirm-userdata') }}">
        @csrf

        <!-- Name -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label :value="__('氏名')" />
                <x-mandatory-mark />
            </div>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Postal-code -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label :value="__('郵便番号')" />
                <x-mandatory-mark />
            </div>
            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" required autocomplete="name" />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label :value="__('住所')" />
                <x-mandatory-mark />
            </div>
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" required autocomplete="postal_code" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-secondary-button onclick="history.back()" class="ml-4">
                {{ __('BACK') }}
            </x-secondary-button>
            <x-primary-button class="ml-4">
                {{ __('Next') }}
            </x-primary-button>

        </div>

    </form>
</x-guest-layout>