<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center leading-tight">
            {{ __('氏名・住所変更') }}
        </h2>
    </x-slot>
    <div style="width: 30%; margin-top: 5%; margin-left: auto; margin-right: auto;">
        <form method="post" action="{{ route('update-address') }}" class="mt-6 space-y-6">
            @csrf
            @method('patch')

            <div>
                <x-input-label for="name" :value="__('氏名')" />
                <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" required placeholder="(例)山田太郎" value="{{ Auth::user()->name }}" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="postal_code" :value="__('Postal_code')" />
                <x-text-input id="postal_code" name="postal_code" type="text" class="block mt-1 w-full" required placeholder="(例)000-0000" value="{{ Auth::user()->postal_code }}" />
                <x-input-error class="mt-2" :messages="$errors->get('postal_code')" />
            </div>

            <div>
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" required placeholder="(例)東京都渋谷区恵比寿南1-2-11フォーシーズン恵比寿ビル4F" value="{{ Auth::user()->address }}" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>


            <div class="flex justify-center items-center gap-4">
                <x-primary-button>{{ __('変更') }}</x-primary-button>

                @if (session('status') === 'address-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</x-app-layout>