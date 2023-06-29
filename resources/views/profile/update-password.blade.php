<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 text-center leading-tight">
            {{ __('パスワード変更') }}
        </h2>
    </x-slot>
    <div style="width: 30%; margin-top: 5%; margin-left: auto; margin-right: auto;">
        <form method="post" action="{{ route('update-password') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div>
                <div class="flex">
                    <x-input-label :value="__('現在のパスワード')" />
                    <x-mandatory-mark />
                </div>
                <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
                <div class="flex">
                    <x-input-label :value="__('新しいパスワード')" />
                    <x-mandatory-mark />
                </div>
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <div class="flex">
                    <x-input-label :value="__('新しいパスワード(確認用)')" />
                    <x-mandatory-mark />
                </div>
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex justify-center items-center gap-4">
                <x-primary-button>{{ __('変更') }}</x-primary-button>

                @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
    </div>
</x-app-layout>