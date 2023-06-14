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

    <div style="width: 50%;" class="mt-7 mx-auto">
        <div class="font-semibold" style="display: flex;" align=center>
            <img src="upload/{{$product->image}}" width="400">
            <div>
                <div>{{$product->name}}</div>
                <div>¥{{$product->price}}</div>
                <div>{{$product->inventory}}点</div>
                <div>@if ($product->listing_status == 0)
                    <div class="text-green-500">出品中</div>
                    @elseif ($product->listing_status == 1)
                    <div class="text-red-500">出品停止中</div>
                    @endif
                </div>
                <div>@if ($product->listing_status == 0)
                    <form action="{{ route('stopListing', $product->id) }}" method="POST">
                        @csrf
                        <x-stopListing-button></x-stopListing-button>
                    </form>
                    @elseif ($product->listing_status == 1)
                    <form action="{{ route('resumeListing', $product->id) }}" method="POST">
                        @csrf
                        <x-resumeListing-button></x-resumeListing-button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>