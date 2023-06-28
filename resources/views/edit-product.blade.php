<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center leading-tight">
            {{ __('商品を編集') }}
        </h2>
    </x-slot>
    <div style="width: 30%; margin-top: 5%; margin-left: auto; margin-right: auto;">
        <form method="post" action="{{ route('update-product' ,['id'=>$product->id]) }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <input type="hidden" id=product_id name="product_id" value="{{ $product->id }}" />

            <!-- name -->
            <div class="mt-4">
                <x-input-label for="product_name" :value="__('商品名')" />
                <x-text-input id="product_name" class="block mt-1 w-full" type="text" name="product_name" required value="{{ $product->name }}" />
                <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
            </div>

            <!-- Category_id -->
            <div class="mt-4">
                <x-input-label for="category_id" :value="__('カテゴリ')" />
                <select id="category-id" name="category_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @foreach ($categories as $id => $category_name)
                    <option value="{{ $id }}" @if ($id==$product->category_id) selected @endif>{{ $category_name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mt-4 flex">
                <!-- Price -->
                <div class="mr-10 flex-1">
                    <x-input-label for="price" :value="__('金額(¥300〜9,999,999)')" />
                    <x-text-input id="price" class="block mt-1 w-full" type="number" min="300" max="9999999" name="price" required autocomplete="price" value="{{ $product->price }}" />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>

                <!-- inventory -->
                <div class="flex-1">
                    <x-input-label for="inventory" :value="__('在庫数')" />
                    <x-text-input id="inventory" class="block mt-1 w-full" type="number" min="1" name="inventory" required autocomplete="inventory" value="{{ $product->inventory }}" />
                    <x-input-error :messages="$errors->get('inventory')" class="mt-2" />
                </div>
            </div>

            <!-- description -->
            <div class="mt-4">
                <x-input-label for="description" :value="__('商品説明')" />
                <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" autocomplete="description" wrap="hard" value="{{ $product->product_description }}" />
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="flex">
                <!-- image -->
                <div class="mt-4">
                    <x-input-label for="image" :value="__('商品画像')" />
                    <input id="image" class="mt-1" type="file" name="image" required autocomplete="image" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <!-- current image -->
                <div class="mt-4 ml-auto">
                    <x-input-label for="current_image" :value="__('現在の画像')" />
                    <img class="bg-white border-2 border-gray-400" src=" /upload/{{ $product->image }}" alt="商品画像" width="150">
                </div>
            </div>


            <div class="flex justify-center items-center gap-4">
                <x-primary-button>{{ __('変更') }}</x-primary-button>

                @if (session('status') === 'product-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</x-app-layout>