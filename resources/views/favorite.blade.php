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

    <table style="width: 50%;" class="max-w-md mx-auto">
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
            @foreach($favorite_products as $favorite_product)
            <tr>
                <td><img src="upload/{{$favorite_product->image}}" width="400"></td>
                <td>{{$favorite_product->name}}</td>
                <td>¥{{$favorite_product->price}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>