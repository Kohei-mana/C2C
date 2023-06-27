<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" align="center">
            {{ __('購入内容確認') }}
        </h2>
    </x-slot>

    <div style="width: 50%; margin-top: auto; margin-left: auto; margin-right: auto;">
        @foreach($cart as $cart_product)
        <div class="p-3 mt-5 sm:p-7 bg-white shadow sm:rounded-lg flex font-semibold flex-row items-center justify-center">
            <img class="border h-30 w-40" src="upload/{{$cart_product->image}}">
            <div class="ml-6 text-2xl">{{$cart_product->name}}</div>
            <div class="ml-6 text-xl">¥{{$cart_product->price}}</div>
            <div class="ml-6 text-xl">{{$cart_product->quantity}}点</div>
            <div class="ml-6 text-xl">¥{{ $subtotal = $cart_product->price * $cart_product->quantity }}</div>
        </div>



        @endforeach
        <div class="mt-6 text-2xl font-semibold text-gray-600 text-right">
            <div>合計：¥ {{ $sum_price }}</div>
        </div>
    </div>

    <form method="POST" action="{{ route('complete-purchase') }}" style="width: 40%;" class="mx-auto mt-5">
        @csrf

        <div class="border-2 border-black">


            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('郵便番号') }}</p>
                <p class="py-1 text-center">〒{{ $postal_code }}</p>
            </div>

            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('住所') }}</p>
                <p class="py-1 text-center">{{ $address }}</p>
            </div>

            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('氏名') }}</p>
                <p class=" py-1 text-center">{{ $name }}</p>
            </div>

            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('カード番号') }}</p>
                <p class=" py-1 text-center">・・・・ - ・・・・ - ・・・・ - {{ substr($card_number, -4) }}</p>
            </div>

            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('有効期限') }}</p>
                <p class=" py-1 text-center">{{ $expiration_month }} / {{ $expiration_year }}</p>
            </div>

            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('CVV') }}</p>
                <p class=" py-1 text-center">・・・</p>
            </div>

            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('カード名義人') }}</p>
                <p class=" py-1 text-center">{{ $cardholder_name }}</p>
            </div>

            <div class="border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('お届け予定日') }}</p>
                <p class=" py-1 text-center">{{ date('Y年n月j日', strtotime('+3 days')) }}</p>
            </div>

        </div>

        <div class="flex items-center justify-end mt-4">
            <x-secondary-button onclick="history.back()" class="ml-4">
                {{ __('BACK') }}
            </x-secondary-button>
            <x-primary-button class="ml-4">
                {{ __('購入') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>