<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ショッピングカート') }}
        </h2>
    </x-slot>

    @if(session('delete_message'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-7xl mx-auto" role="alert">
        <span class="block sm:inline">{{ session('delete_message') }}</span>
    </div>
    @endif

    <div style="width: 60%; margin-top: 4%; margin-left: auto; margin-right: auto; text-center;">
    @if($sum > 0)
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
    @else
        <div class="text-center">
            <h2>カートは空です。</h2>
        </div>
    @endif
        <div class="flex items-center justify-end mt-4">
            <div>合計：</div>
            <div>¥{{ $sum }}</div>
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-secondary-button class="mt-2" onclick="location.href='{{ Route('home') }}'">買い物を続ける</x-secondary-button>
            @if($sum > 0)
            <x-secondary-button class="ml-4 mt-2" onclick="location.href='{{ Route('input-shipping-address') }}'">購入</x-secondary-button>
            @endif
        </div>
    
    </div>
      
        
</x-app-layout>