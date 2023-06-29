<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/dist/output.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
@guest
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 font-sans">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-nav-link :href="route('shopping_cart')" :active="request()->routeIs('shopping_cart')" width="48">
                    {{ __('カート') }}
                </x-nav-link>
                <x-nav-link :href="route('exhibit')" :active="request()->routeIs('exhibit')" width="48">
                    {{ __('出品') }}
                </x-nav-link>

                <x-nav-link :href="route('login')" :active="request()->routeIs('login')" width="48">
                    {{ __('ログイン') }}
                </x-nav-link>
                <x-nav-link :href="route('register')" :active="request()->routeIs('register')" width="48">
                    {{ __('新規登録') }}
                </x-nav-link>
            </div>
        </div>
    </div>
</nav>
@endguest

@auth
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 font-sans">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6 font-sans">
                <x-nav-link :href="route('shopping_cart')" :active="request()->routeIs('shopping_cart')" width="48">
                    {{ __('カート') }}
                </x-nav-link>
                <x-nav-link :href="route('exhibit')" :active="request()->routeIs('exhibit')" width="48">
                    {{ __('出品') }}
                </x-nav-link>

                <x-dropdown aleign="right" width="48">
                    <x-slot name="trigger">
                    <button class="inline-flex items-center px-1 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('マイページ') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('favorite')">
                            {{ __('いいね！一覧') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('listing_history')">
                            {{ __('出品履歴') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('purchase_history')">
                            {{ __('購入履歴') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" class="mb-0">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
@endauth

@if(session('error_message'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative max-w-7xl mx-auto" role="alert">
        <span class="block sm:inline">{{ session('error_message') }}.</span>
    </div>
@endif

@if(session('sucsess_message'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative max-w-7xl mx-auto" role="alert">
        <span class="block sm:inline">{{ session('sucsess_message') }}</span>
    </div>
@endif

@if(session('add_favorite_message'))
    <div class="bg-pink-100 border border-pink-400 text-pink-700 px-4 py-3 rounded relative max-w-7xl mx-auto" role="alert">
        <span class="block sm:inline">{{ session('add_favorite_message') }}</span>
    </div>
@endif

@if(session('remove_favorite_message'))
    <div class="bg-gray-300 border border-gray-400 text-gray-700 px-4 py-3 rounded relative max-w-7xl mx-auto" role="alert">
        <span class="block sm:inline">{{ session('remove_favorite_message') }}</span>
    </div>
@endif

<body class="min-h-screen bg-gray-100 font-sans">

    <div class="py-12">
        <div class="max-w-7xl mx-auto mt-16 sm:px-6 lg:px-8 w-2/3 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="bg-red overflow-hidden shadow-sm sm:rounded-lg flex p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="p-6 text-gray-900 w-1/2">
                    <img src="../upload/{{ $product->image }}" class="w-80 border">
                </div>
                
                <div class="p-6 w-1/2">
                    <div class="text-center ">
                        <div class="mb-2 border-b text-2xl">{{ $product->name }}</div>
                        <div class="mb-2 border-b text-2xl">{{ $product->category_name }}</div>
                        <div class="mb-2 border-b text-2xl">¥{{ $product->price }}</div>
                        <div class="pb-4 mb-4 border-b">{{ $product->product_description }}</div>
                    </div>

                    
                    <div class="flex justify-center">
                        @guest
                            <form action="">
                                <div class="mb-4 flex justify-center">
                                    <p class="">数量：</p>
                                    <input type="number" name="quantity" value=1 min=0 max='0' class="rounded h-6">
                                </div>
                                <x-secondary-button class="ml-10" onclick="location.href='{{ route('login') }}'">{{ __('カートに追加') }}</x-secondary-button>
                            </form>

                            <div class="h-74, w-38">
                                <button onclick="location.href='{{ route('login') }}'">
                                    <img src="{{asset('img/notnice.png')}}" height="30px" width="30px" class="ml-2">
                                </button>
                            </div>
                        @endguest   
                        
                        
                        @auth
                            <form method="POST" action="{{ route('add_to_cart', $product->id) }}">
                                @csrf
                                <div class="mb-4 flex justify-center">
                                    <p class="">数量：</p>
                                    @if($product->inventory - $quantity == 0)
                                    <input type="number" name="quantity" value=0 min=0 max='{{ $product->inventory - $quantity }}' class="rounded h-6">
                                    @else
                                    <input type="number" name="quantity" value=1 min=1 max='{{ $product->inventory - $quantity }}' class="rounded h-6">
                                    @endif
                                </div>
                                <x-primary-button class="ml-10">{{ __('カートに追加') }}</x-primary-button>
                            </form>
                            @if($favorite)
                            <form method="POST" action="{{ route('notfavorite', $product->id) }}" class="">
                                @csrf
                                <button type="submit">
                                    <img src="{{asset('img/nicebutton.png')}}" height="30px" width="30px" class="ml-2">
                                </button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('addfavorite', $product->id) }}">
                                @csrf
                                <button type="submit">
                                    <img src="{{asset('img/notnice.png')}}" height="30px" width="30px" class="ml-2">
                                </button>
                            </form>
                            @endif
                        @endauth

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>