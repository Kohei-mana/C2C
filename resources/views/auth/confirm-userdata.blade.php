<x-guest-layout>
    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <div class="border-2 border-black">
            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('Email') }}</p>
                <p class="py-1 text-center">{{ $email }}</p>
            </div>
            

            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 w-30 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('Name') }}</p>
                <p class=" py-1 text-center">{{ $name }}</p>
            </div>
            
            <!-- <x-input-label for="name" :value="__('Name')" />
            <x-label-item id="name" class="block mb-4 w-full" value="{{ $name }}" /> -->
            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 w-30 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('Postal_code') }}</p>
                <p class=" py-1 text-center">{{ $postal_code }}</p>
            </div>

            <div class="border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 w-30 float-left border-r-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('Address') }}</p>
                <p class=" py-1 text-center">{{ $address }}</p>
            </div>
        </div>

        

        <div class="flex items-center justify-end mt-4">
            <x-secondary-button class="ml-4">
                {{ __('BACK') }}
            </x-secondary-button>
            <x-primary-button class="ml-4">
                {{ __('REGISTER') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
