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

    <table style="width: 50%;" class="mx-auto">
        <thead>
            <tr>
                <th>商品イメージ</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>出品状況</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><img src="upload/{{$product->image}}" width="400"></td>
                <td>{{$product->name}}</td>
                <td>¥{{$product->price}}</td>
                <td>{{$product->inventory}}点</td>
                <td>@if ($product->listing_status == 0)
                    出品中
                    @elseif ($product->listing_status == 1)
                    出品停止中
                    @endif
                </td>
                <td>@if ($product->listing_status == 0)
                    <form action="{{ route('stopListing', $product->id) }}" method="POST">
                        @csrf
                        <x-stopListing-button></x-stopListing-button>
                    </form>
                    @elseif ($product->listing_status == 1)

                    <x-resumeListing-button></x-resumeListing-button>

                    @endif
                </td>
            </tr>
        </tbody>
    </table>
</x-app-layout>