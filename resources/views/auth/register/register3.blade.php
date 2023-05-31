<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="post" action="{{ route('register2') }}" class="mt-6 space-y-6">
                @csrf
                <input type="hidden" name="name" value="{{ $inputs['email'] }}">
                <input type="hidden" name="name" value="{{ $inputs['password'] }}">
                <input type="hidden" name="name" value="{{ $inputs['name'] }}">
                <input type="hidden" name="name" value="{{ $inputs['postal-code'] }}">
                <input type="hidden" name="address" value="{{ $inputs['address'] }}">

                <div class="overflow-hidden bg-white shadow sm:rounded-lg">
                    <div class="border-t">
                        <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium">メールアドレス</dt>
                                <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $inputs['email'] }}</dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium">パスワード</dt>
                                <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $inputs['password'] }}</dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium">名前</dt>
                                <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $inputs['name'] }}</dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium">郵便番号</dt>
                                <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $inputs['postal-code'] }}</dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium">住所</dt>
                                <dd class="mt-1 text-sm sm:col-span-2 sm:mt-0">{{ $inputs['address'] }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>
                <div class="mt-4">
                    <x-primary-button name="back">戻る</x-primary-button>
                    <x-primary-button>登録</x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>