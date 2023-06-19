<x-app-layout>
    <div style="width: 60%; margin-top: 5%; margin-left: auto; margin-right: auto;">
        <div class="mt-7 mx-auto font-semibold text-center" style="width: 35%;">
            <h2 class="mb-4 text-2xl text-gray-600">
                {{ __('THANK YOU') }}<br>
                {{ __('出品が完了しました') }}
            </h2>

            <div class="flex items-center justify-center mt-4">
                <x-secondary-button class="ml-4 text-xl">
                    {{ __('ホームに戻る') }}
                </x-secondary-button>
            </div>
        </div>
    </div>
</x-app-layout>