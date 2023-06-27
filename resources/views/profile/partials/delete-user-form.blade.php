<div class="space-y-6 text-center">
    <header>
        <h2 class="text-lg font-medium text-gray-900 font-semibold">
            {{ __('アカウントを削除する') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 font-semibold">
            {{ __('アカウントを削除すると、全てのデータが完全に削除されます。') }}
            <br>
            {{ __('復元することはできないので、削除前に必要なデータ等がないかご確認ください。') }}
        </p>
    </header>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('削除') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('パスワードを入力してください') }}
            </h2>
            <div class="mt-6 flex justify-center">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-center">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="ml-3">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</div>