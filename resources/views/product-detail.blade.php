<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>{{ $product->name }}</div>
                    <img src="../img/{{ $product->image }}" width="300">
                    <div>{{ $product->category_name }}</div>
                    <div>{{ $product->price }}</div>
                    <div>{{ $product->product_description }}</div>
                </div>
                <form action="">
                    <p>数量</p>
                    <input type="number" min=1 max='{{ $product->inventory }}'>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>