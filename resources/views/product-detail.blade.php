<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/dist/output.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-red overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="w-40">{{ $product->name }}</div>
                    <img src="../upload/{{ $product->image }}" class="w-80">
                    <div>{{ $product->category_name }}</div>
                    <div>{{ $product->price }}</div>
                    <div>{{ $product->product_description }}</div>
                </div>
                <form method="GET" action="{{ route('add_to_cart', $product->id) }}">
                    <p>数量</p>
                    <input type="number" name="quantity" value=1 min=1 max='{{ $product->inventory }}'>

                    <div>
                    <span>
                        @guest
                            <x-secondary-button>{{ __('カートに追加') }}</x-secondary-button>

                            <a href="{{ route('addfavorite', $product->id) }}" class="btn btn-secondary btn-sm height-30">
                                <img src="{{asset('img/notnice.png')}}" height="30px" width="30px">
                            </a>
                        @endguest   
                        
                        <!-- ユーザーが「いいね」をしていたら -->
                        @auth
                            <x-primary-button>{{ __('カートに追加') }}</x-primary-button>
                            @if($favorite)
                            <a href="{{ route('notfavorite', $product->id) }}" class="btn btn-success btn-sm">
                                <img src="{{asset('img/nicebutton.png')}}" height="30px" width="30px">
                            </a>
                            @else
                            <a href="{{ route('addfavorite', $product->id) }}" class="btn btn-secondary btn-sm height-30">
                                <img src="{{asset('img/notnice.png')}}" height="30px" width="30px">
                            </a>
                            @endif
                        @endauth
                    </span>
                    </div>

                </form>
                
            </div>
        </div>
    </div>