<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('出品履歴') }}
            <div align="right">

                <x-secondary-button onclick="location.href='{{ route('favorite') }}'">{{ __('いいね！一覧') }}</x-secondary-button>
                <x-secondary-button onclick="location.href='{{ route('listing_history') }}'">{{ __('出品履歴') }}</x-secondary-button>
                <x-secondary-button onclick="location.href='{{ route('purchase_history') }}'">{{ __('購入履歴') }}</x-secondary-button>

            </div>
        </h2>
    </x-slot>

    <div class="mt-7 mx-auto font-semibold" style="width: 35%;">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-5">
            @if (count($exhibit_products) > 0)
            @foreach($exhibit_products as $exhibit_product)
            <a href="{{ route('exhibition-product', ['id'=>$exhibit_product->id]) }}" class="scale-100 p-3 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <div class="mx-auto" style="display: flex;" align=center>
                    <img src="../upload/{{$exhibit_product->image}}" width="100">
                    <div>
                        <div>{{$exhibit_product->name}}</div>
                        <div>¥{{$exhibit_product->price}}</div>
                        <div>在庫：{{$exhibit_product->inventory}}点</div>
                        <div>@if ($exhibit_product->listing_status == 0)
                            <div class="text-green-500">出品中</div>
                            @elseif ($exhibit_product->listing_status == 1)
                            <div class="text-red-500">出品停止中</div>
                            @endif
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
            @else
                <div class="text-center">
                    <h2>出品した商品はありません。</h2>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>