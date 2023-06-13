<x-app-layout>
    <table style="width: 50%;" class="max-w-md mx-auto">
        <h2 class="mb-4 text-sm text-gray-600">
            {{ __('THANK YOU') }}<br>
            {{ __('出品が完了しました') }}
        </h2>


        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('ホームに戻る') }}
            </x-primary-button>
        </div>
    </table>
</x-app-layout>