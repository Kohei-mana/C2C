<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center leading-tight">
            {{ __('住所変更') }}
        </h2>
    </x-slot>
    <section style="width: 25%; margin-top: 5%; margin-left: auto; margin-right: auto;">
        <form method="post" action="{{ route('update-address') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="postal_code" :value="__('Postal_code')" />
                <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" required autocomplete="postal_code" />
                <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
            </div>

            <div>
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" required autocomplete="address" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>


            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('変更') }}</x-primary-button>

                @if (session('status') === 'address-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </section>
</x-app-layout>