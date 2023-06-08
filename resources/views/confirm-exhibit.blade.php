<x-guest-layout>
    <form method="POST" action="{{ route('complete-exhibit') }}">
        @csrf

        <div class="border-2 border-black">
            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('商品名') }}</p>
                <p class="py-1 text-center">{{ $name }}</p>
            </div>

            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('カテゴリ名') }}</p>
                <p class="py-1 text-center">{{ $category_id }}</p>
            </div>

            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 w-30 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('価格') }}</p>
                <p class=" py-1 text-center">{{ $price }}</p>
            </div>

            <div class="border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 w-30 float-left border-r-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('在庫数') }}</p>
                <p class=" py-1 text-center">{{ $inventory }}</p>
            </div>

            <div class="border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 w-30 float-left border-r-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('商品説明') }}</p>
                <p class=" py-1 text-center">{{ $description }}</p>
            </div>

            <div class="border-b-2 border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ __('商品画像') }}</p>
                <p class="py-1 text-center">{{ $image }}</p>
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
</x-guest-layout>