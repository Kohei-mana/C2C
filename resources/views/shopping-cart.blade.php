<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ショッピングカート') }}
        </h2>
    </x-slot>

        <div style="width: 75%; margin-top: 4%; margin-left: auto; margin-right: auto;">
        @foreach($cart as $cart_product)
            <div class="p-4 mt-4 sm:p-8 bg-white shadow sm:rounded-lg flex">
                <div class="h-30 w-40"><img class="border h-30 w-40" src="upload/{{$cart_product->image}}"></div>
                <div class="w-3/5 text-center">{{$cart_product->name}}</div>
                <div class="w-1/5 text-center">¥{{$cart_product->price}}</div>
                <div class="w-1/5 text-center">{{$cart_product->quantity}}点</div>
                <div class="w-1/5 text-center">¥{{ $subtotal = $cart_product->price * $cart_product->quantity }}</div>
                <div class="w-1/5 text-center"><a href="{{ Route('remove_from_cart', ['id'=>$cart_product->id]) }}">削除</a></div>
            </div>
            @endforeach
            <div class="mt-4">
                <div>合計</div>
                <div>¥{{ $sum }}</div>
            </div>
        </div>
        
</x-app-layout>