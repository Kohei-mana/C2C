<x-guest-layout>
    <form method="POST" action="{{ route('register.input-userdata') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label :value="__('メールアドレス')" />
                <x-mandatory-mark />
            </div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label :value="__('パスワード')" />
                <x-mandatory-mark />
            </div>
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <div class="flex">
                <x-input-label :value="__('パスワード(確認用)')" />
                <x-mandatory-mark />
            </div>
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Next') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>