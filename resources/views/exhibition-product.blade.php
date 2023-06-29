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

    @if(session('error_message'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-7xl mx-auto" role="alert">
        <span class="block sm:inline">{{ session('error_message') }}.</span>
    </div>
    @endif
    <div class="">
        <div class="max-w-7xl mx-auto mt-16 sm:px-6 lg:px-8 w-2/3 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="bg-red overflow-hidden shadow-sm sm:rounded-lg flex p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="p-6 text-gray-900 w-1/2">
                    <img src="../upload/{{ $exhibit_product->image }}" class="w-80 border">
                </div>
                
                <div class="p-6 w-1/2">
                    <div class="text-center ">
                        <div class="mb-2 border-b text-2xl">{{ $exhibit_product->name }}</div>
                        <div class="mb-2 border-b text-2xl">{{ $exhibit_product->category_name }}</div>
                        <div class="mb-2 border-b text-2xl">¥{{ $exhibit_product->price }}</div>
                        <div class="mb-2 border-b text-2xl">在庫：{{ $exhibit_product->inventory }}点</div>
                        <div class="pb-4 mb-4 border-b">{{ $exhibit_product->product_description }}</div>
                    </div>

                    <div class="flex justify-center">

                        @if ($exhibit_product->listing_status == 0)
                        <div style="color: green;" class="">出品中</div>
                        @elseif ($exhibit_product->listing_status == 1)
                        <div style="color: red;" class="">出品停止中</div>
                        @endif
                    </div>
                    <div class="flex justify-center">
                        @if ($exhibit_product->listing_status == 0)
                        <form action="{{ route('updateListing', $exhibit_product->id) }}" method="POST">
                            @csrf
                            <x-stopListing-button class="flex justify-center"></x-stopListing-button>
                        </form>
                        @elseif ($exhibit_product->listing_status == 1)
                        <form action="{{ route('updateListing', $exhibit_product->id) }}" method="POST">
                            @csrf
                            <x-resumeListing-button class="flex justify-center"></x-resumeListing-button>
                        </form>
                        @endif
                    </div>
                    <a class="flex justify-center" href="{{ route('edit-product', ['id'=>$exhibit_product->id]) }}">
                        <x-secondary-button class="mt-6">{{ __('編集する') }}</x-secondary-button>
                    </a>
                    
                </div>
            </div>
        </div>
    </div>
    <div style="display: flex; justify-content: center;">
        <div class="border-t-2 border-r-2 border-l-2 border-black mt-5 mb-20" style="width: 67%;">
            <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300 font-semibold'>{{ __('購入者氏名') }}</p>
            <p class="px-1 py-1 text-center h-8 border-b-2 border-black font-semibold">{{ __('送付先住所') }}</p>
            @foreach($buyer_addresses as $buyer_address)
            <div class="border-black h-8">
                <p class='inline-block w-1/4 font-normal h-8 float-left border-r-2 border-b-2 border-black px-1 py-1 text-center bg-gray-300'>{{ $buyer_address->name }}</p>
                <p class="px-1 py-1 text-center h-8 border-b-2 border-black">〒{{ $buyer_address->postal_code }}　{{ $buyer_address->address }}</p>
            </div>
            @endforeach
        </div>
    </div>

</x-app-layout>