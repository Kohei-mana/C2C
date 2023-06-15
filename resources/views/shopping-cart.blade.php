<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ショッピングカート') }}
        </h2>
    </x-slot>

    <table style="width: 50%;" class="max-w-md mx-auto">
        <thead>
            <tr>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>数量</th>
                <th>小計</th>
            </tr>
        </thead>

        <tbody class='border-gray-300'>
            @foreach($cart as $cart_product)
            <tr>
                <td><img src="upload/{{$cart_product->image}}" width="400"></td>
                <td>{{$cart_product->name}}</td>
                <td>¥{{$cart_product->price}}</td>
                <td>{{$cart_product->quantity}}点</td>
                <td>{{ $subtotal = $cart_product->price * $cart_product->quantity }}</td>
                <td><a href="{{ Route('remove_from_cart', ['id'=>$cart_product->id]) }}">削除</a></td>
            </tr>
            @endforeach
        </tbody>
        
        <div>合計</div>
        <div>{{ $sum }}</div>
    </table>
</x-app-layout>