<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" align="center">
            {{ __('送付先入力') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('input-payment-information') }}" style="width: 30%;" class="mx-auto">
        @csrf

        <!-- Postal-code -->
        <div class="mt-10">
            <div class="flex">
                <x-input-label :value="__('郵便番号')" />
                <x-mandatory-mark />
            </div>
            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" required placeholder="(例)000-0000" value="{{ Auth::user()->postal_code }}" />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label :value="__('住所')" />
                <x-mandatory-mark />
            </div>
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" required placeholder="(例)東京都渋谷区恵比寿南1-2-11フォーシーズン恵比寿ビル4F" value="{{ Auth::user()->address }}" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label :value="__('氏名')" />
                <x-mandatory-mark />
            </div>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required placeholder="(例)山田太郎" value="{{ Auth::user()->name }}" />
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