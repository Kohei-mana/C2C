<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" align="center">
            {{ __('決済情報入力') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('input-payment-information') }}" enctype="multipart/form-data" style="width: 20%;" class="mx-auto">
        @csrf

        <!-- Card Number -->
        <div class="mt-4">
            <x-input-label for="card_number" :value="__('カード番号')" />

            <x-text-input id="card_number" class="block mt-1 w-full" type="text" name="card_number" required />

            <x-input-error :messages="$errors->get('card_number')" class="mt-2" />
        </div>

        <!-- Expiration Date and CVV -->
        <div class="mt-4 flex">
            <!-- Expiration Date -->
            <div class="mr-4">
                <x-input-label for="expiration_date" :value="__('有効期限')" />

                <div class="flex">
                    <!-- Month -->
                    <div>
                        <select id="expiration_month" name="expiration_month" class="block mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @for ($month = 1; $month <= 12; $month++) <option value="{{ $month }}">{{ sprintf("%02d", $month) }}</option>
                                @endfor
                        </select>

                        <x-input-error :messages="$errors->get('expiration_month')" class="mt-2" />
                    </div>

                    <!-- Year -->
                    <div class="ml-2">
                        <select id="expiration_year" name="expiration_year" class="block mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            @for ($year = date('Y'); $year <= date('Y') + 10; $year++) <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                        </select>

                        <x-input-error :messages="$errors->get('expiration_year')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- CVV -->
            <div>
                <x-input-label for="cvv" :value="__('CVV')" />

                <x-text-input id="cvv" class="block mt-1 w-full" type="text" name="cvv" required />

                <x-input-error :messages="$errors->get('cvv')" class="mt-2" />
            </div>
        </div>

        <!-- Cardholder Name -->
        <div class="mt-4">
            <x-input-label for="cardholder_name" :value="__('カード名義人')" />

            <x-text-input id="cardholder_name" class="block mt-1 w-full" type="text" name="cardholder_name" required />

            <x-input-error :messages="$errors->get('cardholder_name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-secondary-button onclick="history.back()" class="ml-4">
                {{ __('戻る') }}
            </x-secondary-button>
            <x-primary-button class="ml-4">
                {{ __('次へ') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>