<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" align="center">
            {{ __('送付先入力') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('input-payment-information') }}" enctype="multipart/form-data" style="width: 30%;" class="mx-auto">
        @csrf

        <!-- Postal-code -->
        <div class="mt-4">
            <x-input-label for="postal_code" :value="__('postal-code')" />

            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" required value="{{ Auth::user()->postal_code }}" />

            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('address')" />

            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" required value="{{ Auth::user()->address }}" />

            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required value="{{ Auth::user()->name }}" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
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
</x-app-layout>