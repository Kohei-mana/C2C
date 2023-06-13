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

    <table style="width: 50%;" class="max-w-sm mx-auto">
        <thead>
            <tr>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>出品状況</th>
                <th></th>
            </tr>
        </thead>
        <tbody class='border-gray-300'>
            @if (is_countable($exhibit_products) > 0)
            @foreach($exhibit_products as $exhibit_product)
            <tr>
                <td><img src="upload/{{$exhibit_product->image}}" width="400"></td>
                <td>{{$exhibit_product->name}}</td>
                <td>¥{{$exhibit_product->price}}</td>
                <td>{{$exhibit_product->inventory}}点</td>
                <td>@if ($exhibit_product->listing_status == 0)
                    出品中
                    @elseif ($exhibit_product->listing_status == 1)
                    出品停止中
                    @endif
                </td>
                <td><a href="{{ route('exhibition-product', ['id'=>$exhibit_product->id]) }}" class="btn btn-primary">詳細</a></td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</x-app-layout>