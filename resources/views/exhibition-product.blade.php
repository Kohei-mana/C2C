<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('出品詳細') }}
            <div align="right">
                <x-secondary-button onclick="location.href='{{ route('favorite') }}'">{{ __('いいね！一覧') }}</x-secondary-button>
                <x-secondary-button onclick="location.href='{{ route('listing_history') }}'">{{ __('出品履歴') }}</x-secondary-button>
                <x-secondary-button onclick="location.href='{{ route('purchase_history') }}'">{{ __('購入履歴') }}</x-secondary-button>
            </div>
        </h2>
    </x-slot>

    <div style="width: 60%; margin-top: 5%; margin-left: auto; margin-right: auto;">
        <div class="scale-100 p-3 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
            <div style="font-size: 25px; font-weight: 600; display: flex; align-items: center; justify-content: center;">
                <img src="../upload/{{$exhibit_product->image}}" width="600">
                <div style="margin-left: 2rem;">
                    <div>{{$exhibit_product->name}}</div>
                    <div>¥{{$exhibit_product->price}}</div>
                    <div>{{$exhibit_product->inventory}}点</div>
                    <div>
                        @if ($exhibit_product->listing_status == 0)
                        <div style="color: green;">出品中</div>
                        @elseif ($exhibit_product->listing_status == 1)
                        <div style="color: red;">出品停止中</div>
                        @endif
                    </div>
                    <div>
                        @if ($exhibit_product->listing_status == 0)
                        <form action="{{ route('updateListing', $exhibit_product->id) }}" method="POST">
                            @csrf
                            <x-stopListing-button></x-stopListing-button>
                        </form>
                        @elseif ($exhibit_product->listing_status == 1)
                        <form action="{{ route('updateListing', $exhibit_product->id) }}" method="POST">
                            @csrf
                            <x-resumeListing-button></x-resumeListing-button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>