<x-app-layout>
    <div class="flex items-center justify-center h-screen">
        <div class="text-center">
            <h2 class="text-4xl font-semibold text-gray-600 mb-4">
                {{ __('THANK YOU') }}<br>
                {{ __('出品が完了しました') }}
            </h2>

            <div class="mt-4">
                <x-secondary-button onclick="location.href='{{ route('home') }}'" class="text-2xl">
                    {{ __('ホームに戻る') }}
                </x-secondary-button>
            </div>
        </div>
    </div>
</x-app-layout>