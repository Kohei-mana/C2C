<x-guest-layout>
    <form method="GET" action="{{ route('complete') }}">
        @csrf

        
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-4">
                {{ __('BACK') }}
            </x-primary-button>

            <x-primary-button class="ml-4">
                {{ __('REGISTER') }}
            </x-primary-button>

        </div>
    </form>
</x-guest-layout>