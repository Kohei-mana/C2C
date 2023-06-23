<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ショッピングカート') }}
        </h2>
    </x-slot>

        <div style="width: 60%; margin-top: 4%; margin-left: auto; margin-right: auto;">
            @foreach($productsInACart as $cart_product)
            <form action="{{ Route('remove_from_cart', ['id'=>$cart_product->id]) }}" method="POST">
                <div class="p-4 mt-4 sm:p-8 bg-white shadow sm:rounded-lg flex">
                @csrf
                    <div class="h-30 w-40"><img class="border h-30 w-40" src="upload/{{$cart_product->image}}"></div>
                    <div class="w-3/5 text-center">{{$cart_product->name}}</div>
                    <div class="w-1/5 text-center">¥{{$cart_product->price}}</div>
                    <div class="w-1/5 text-center">{{$cart_product->quantity}}点</div>
                    <div class="w-1/5 text-center">¥{{ $subtotal = $cart_product->price * $cart_product->quantity }}</div>
                    <div class="w-1/5 text-center text-red-600">
                        <x-primary-button>削除</x-primary-button>
                    </div>
                </div>
            </form>
            @endforeach
            <div class="flex items-center justify-end mt-4">
                <div>合計：</div>
                <div>¥{{ $sum }}</div>
            </div>
            <div class="flex items-center justify-end mt-4">
            <x-secondary-button class="mt-2" onclick="location.href='{{ Route('home') }}'">買い物を続ける</x-secondary-button>
                <x-secondary-button class="ml-4 mt-2" onclick="location.href='{{ Route('input-shipping-address') }}'">購入</x-secondary-button>
            </div>
        </div>
      
        
</x-app-layout>