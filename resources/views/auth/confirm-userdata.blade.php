<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="password" value="{{ $password }}">
        <input type="hidden" name="password_confirmation" value="{{ $password_confirmation }}">
        <input type="hidden" name="name" value="{{ $name }}">
        <input type="hidden" name="postal_code" value="{{ $postal_code }}">
        <input type="hidden" name="address" value="{{ $address }}">
        
        <div class="flex items-center justify-end mt-4">
            <span>メールアドレス：{{ $email }}</span>
            <span>氏名：{{ $name }}</span>
            <span>郵便番号{{ $postal_code }}</span>
            <span>住所{{ $address }}</span>

            <x-secondary-button class="ml-4">
                {{ __('BACK') }}
            </x-secondary-button>

            <x-primary-button class="ml-4">
                {{ __('REGISTER') }}
            </x-primary-button>

        </div>
    </form>
</x-guest-layout>
