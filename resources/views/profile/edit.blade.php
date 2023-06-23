<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('マイページ') }}
            <div align="right">
                <x-secondary-button onclick="location.href='{{ route('favorite') }}'">{{ __('いいね！一覧') }}</x-secondary-button>
                <x-secondary-button onclick="location.href='{{ route('listing_history') }}'">{{ __('出品履歴') }}</x-secondary-button>
                <x-secondary-button onclick="location.href='{{ route('purchase_history') }}'">{{ __('購入履歴') }}</x-secondary-button>
            </div>
        </h2>
    </x-slot>

    <div style="width: 50%; margin-top: 5%; margin-left: auto; margin-right: auto;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="border-2 border-black">
                <div class="border-b-2 border-black h-8">
                    <p class='inline-block w-1/4 font-normal h-8 w-30 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('Name') }}</p>
                    <p class=" py-1 text-center">{{ \Auth::user()->name; }}</p>
                </div>

                <div class="border-b-2 border-black h-8">
                    <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('Email') }}</p>
                    <p class="py-1 text-center">{{ \Auth::user()->email; }}</p>
                </div>

                <div class="border-b-2 border-black h-8">
                    <p class='inline-block w-1/4 font-normal h-8 w-30 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('Postal_code') }}</p>
                    <p class=" py-1 text-center">〒 {{ \Auth::user()->postal_code; }}</p>
                </div>

                <div class="border-black h-8">
                    <p class='inline-block w-1/4 font-normal h-8 w-30 float-left border-r-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('Address') }}</p>
                    <p class=" py-1 text-center">{{ \Auth::user()->address; }}</p>
                </div>
            </div>
        </div>
    </div>

    <div style="width: 50%; margin-top: 4%; margin-left: auto; margin-right: auto;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg flex justify-between">
                <x-setting-button class="mr-6" onclick="location.href='{{ route('update-email-page') }}'">{{ __('メールアドレス変更') }}</x-setting-button>
                <x-setting-button onclick="location.href='{{ route('update-password-page') }}'">{{ __('パスワード変更') }}</x-setting-button>
                <x-setting-button class="ml-6" onclick="location.href='{{ route('update-address-page') }}'">{{ __('住所変更') }}</x-setting-button>
            </div>



            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>