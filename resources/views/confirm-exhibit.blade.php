<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" align="center">
            {{ __('出品内容確認') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('complete-exhibit') }}" style="width: 50%;" class="max-w-md mx-auto mt-10">

        @csrf

        <div class="border-2 border-black">

            <img src="{{ asset('upload/' . $image) }}" alt="Product Image" class="border-b-2 border-black bg-white">

            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('商品名') }}</p>
                <p class="py-1 text-center">{{ $product_name }}</p>
            </div>

            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('カテゴリ') }}</p>
                <p class="py-1 text-center">{{ $category_name }}</p>
            </div>

            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('価格') }}</p>
                <p class=" py-1 text-center">¥{{ $price }}</p>
            </div>

            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('在庫数') }}</p>
                <p class=" py-1 text-center">{{ $inventory }}点</p>
            </div>

            <div class=" border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('商品説明') }}</p>
                <p class=" py-1 text-center">{{ $description }}</p>
            </div>

        </div>



        <div class="flex items-center justify-end mt-4">
            <x-secondary-button onclick="history.back()" class="ml-4">
                {{ __('BACK') }}
            </x-secondary-button>
            <x-primary-button class="ml-4">
                {{ __('REGISTER') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>