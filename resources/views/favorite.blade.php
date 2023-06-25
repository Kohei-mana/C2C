<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('いいね！一覧') }}
            <div alaign="right">
                <x-secondary-button onclick="location.href='{{ route('favorite') }}'">{{ __('いいね！一覧') }}</x-secondary-button>
                <x-secondary-button onclick="location.href='{{ route('listing_history') }}'">{{ __('出品履歴') }}</x-secondary-button>
                <x-secondary-button onclick="location.href='{{ route('purchase_history') }}'">{{ __('購入履歴') }}</x-secondary-button>
            </div>
        </h2>
    </x-slot>

    <div class="mt-7 mx-auto font-semibold" style="width: 35%;">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-5">
            @if (is_countable($favorite_products) > 0)
            @foreach($favorite_products as $favorite_product)
            <a href="{{ route('product-detail', ['id'=>$favorite_product->id]) }}" class="scale-100 p-3 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <div class="mx-auto" style="display: flex;" aleign=center>
                    <img src="../upload/{{$favorite_product->image}}" width="100">
                    <div>
                        <div>{{$favorite_product->name}}</div>
                        <div>¥{{$favorite_product->price}}</div>
                    </div>
                </div>
            </a>
            @endforeach
            @endif
        </div>
    </div>
</x-app-layout>