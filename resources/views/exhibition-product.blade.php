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
    <div style="width: 100%; display: flex; justify-content: center; margin-top: 5%;">
        <div style="width: 45%; display: flex; align-items: center; justify-content: space-between; background-color: white; border-radius: 0.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
            <div style="flex: 2; padding: 3rem;">
                <img src="../upload/{{$exhibit_product->image}}" width="250">
            </div>
            <div class="text-center" style="flex: 2; padding: 4rem;">
                <div style="font-size: 30px; font-weight: 600;">{{$exhibit_product->name}}</div>
                <div style="font-size: 20px; font-weight: 600;">
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