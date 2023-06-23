<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('購入履歴') }}
            <div align="right">
                <x-secondary-button onclick="location.href='{{ route('favorite') }}'">{{ __('いいね！一覧') }}</x-secondary-button>
                <x-secondary-button onclick="location.href='{{ route('listing_history') }}'">{{ __('出品履歴') }}</x-secondary-button>
                <x-secondary-button onclick="location.href='{{ route('purchase_history') }}'">{{ __('購入履歴') }}</x-secondary-button>
            </div>
        </h2>
    </x-slot>

    <div class="mt-7 mx-auto font-semibold" style="width: 35%;">
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6 lg:gap-5">
            @if (is_countable($completions) > 0)
            @foreach($completions as $completion)
            <div class="scale-100 p-2 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                <div class="mx-auto" style="display: flex;" align=center>
                    <img src="upload/{{$completion->product->image}}" width="100">
                    <div>
                        <div>{{$completion->order->created_at}}</div>
                        <div>{{$completion->product->name}}</div>
                        <div>¥{{$completion->product->price}}</div>
                        <div>数量：{{$completion->quantity}}点</div>
                        <div>小計：¥{{$completion->price}}</div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</x-app-layout>