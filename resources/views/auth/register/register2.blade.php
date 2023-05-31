<x-guest-layout>
    <form method="GET" action="{{ route('register3') }}">
        @csrf

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Postal-code -->
        <div class="mt-4">
            <x-input-label for="postal-code" :value="__('postal-code')" />

            <x-text-input id="postal-code" class="block mt-1 w-full"
                            type="text"
                            name="postal-code"
                            required autocomplete="name" />

            <x-input-error :messages="$errors->get('postal-code')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('address')" />

            <x-text-input id="address" class="block mt-1 w-full"
                            type="text"
                            name="address" required autocomplete="postal-code" />

            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ml-4">
                {{ __('Next') }}
            </x-primary-button>

        </div>
    </form>
</x-guest-layout>