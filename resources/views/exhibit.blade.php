<x-app-layout>
    <form method="POST" action="{{ route('confirm-exhibit') }}" enctype="multipart/form-data" style="width: 50%;" class="max-w-sm mx-auto">
        @csrf

        <!-- name -->
        <div class="mt-4">
            <x-input-label for="product_name" :value="__('商品名')" />
            <x-text-input id="product_name" class="block mt-1 w-full" type="text" name="product_name" required />
            <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
        </div>

        <!-- Category_id -->
        <div class="mt-4">
            <x-input-label for="category_id" :value="__('カテゴリ')" />
            <select id="category-id" name="category_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                @foreach ($categories as $id => $category_name)
                <option value="{{ $id }}">{{ $category_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Price -->
        <div class="mt-4">
            <x-input-label for="price" :value="__('金額')" />
            <x-text-input id="price" class="block mt-1 w-full" type="number" min="300" max="9999999" name="price" required autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <!-- inventory -->
        <div class="mt-4">
            <x-input-label for="inventory" :value="__('在庫数')" />
            <x-text-input id="inventory" class="block mt-1 w-full" type="number" min="1" name="inventory" required autocomplete="inventory" />
            <x-input-error :messages="$errors->get('inventory')" class="mt-2" />
        </div>

        <!-- description -->
        <div class="mt-4" style="height: 200px;">
            <x-input-label for="description" :value="__('商品説明')" />
            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" autocomplete="description" wrap="hard" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- image -->
        <div class="mt-4">
            <x-input-label for="image" :value="__('商品画像')" />
            <x-text-input id="image" class="block mt-1" type="file" name="image" required autocomplete="image" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-secondary-button onclick="history.back()" class="ml-4">
                {{ __('BACK') }}
            </x-secondary-button>
            <x-primary-button class="ml-4">
                {{ __('Next') }}
            </x-primary-button>
        </div>

    </form>
</x-app-layout>