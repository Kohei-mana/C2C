<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('マイページ') }}
            <div align="right">
                <x-primary-button onclick="location.href='http://localhost/favorite'">{{ __('いいね！一覧') }}</x-primary-button>
                <x-primary-button onclick="location.href='http://localhost/listing_history'">{{ __('出品履歴') }}</x-primary-button>
                <x-primary-button onclick="location.href='http://localhost/purchase_history'">{{ __('購入履歴') }}</x-primary-button>
            </div>
        </h2>
    </x-slot>

    <div class="py-12">
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

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-address-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>