<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $game->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 bg-white bg-opacity-80 rounded-lg shadow p-8">
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Game Image -->
                <div>
                    <div class="bg-gray-100 rounded-lg overflow-hidden">
                        <img src="{{ $game->cover_url }}" alt="{{ $game->title }}" class="w-full h-96 object-cover">
                    </div>

                    <!-- Video Trailer -->
                    @if ($game->youtube_embed)
                        <div class="mt-4">
                            <p class="text-sm text-gray-600 mb-2">Video Trailer</p>
                            <div class="bg-gray-100 rounded aspect-video">
                                <iframe width="100%" height="100%" src="{{ $game->youtube_embed }}" frameborder="0"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Game Details -->
                <div>
                    <h1 class="text-4xl font-bold mb-4">{{ $game->title }}</h1>

                    <!-- Developer Info -->
                    <p class="text-gray-600 mb-4">
                        Oleh <strong>{{ $game->developer->name }}</strong>
                    </p>

                    <!-- Categories -->
                    @if ($game->categories->count())
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Kategori</p>
                            <div class="flex gap-2 flex-wrap">
                                @foreach ($game->categories as $category)
                                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Price -->
                    <div class="mb-6">
                        @if ($game->price > 0)
                            <p class="text-5xl font-bold text-green-600">
                                Rp {{ number_format($game->price, 0, ',', '.') }}
                            </p>
                        @else
                            <p class="text-4xl font-bold text-blue-600">GRATIS</p>
                        @endif
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="font-bold text-lg mb-2">Deskripsi</h3>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $game->description }}
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        @if (auth()->check())
                            <form action="{{ route('cart.add', $game) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-bold text-lg">
                                    Tambahkan ke Keranjang
                                </button>
                            </form>

                            <form action="{{ route('wishlist.store', $game) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="w-full px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-bold">
                                    Tambahkan ke Wishlist
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}"
                                class="block text-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-bold text-lg">
                                Login untuk membeli
                            </a>
                        @endif
                    </div>

                    <!-- Game Status -->
                    <div class="mt-6 p-4 bg-gray-100 rounded">
                        <p class="text-sm text-gray-600">
                            Status: <span class="font-semibold">{{ ucfirst($game->status) }}</span>
                        </p>
                        @if ($game->package)
                            <p class="text-sm text-gray-600 mt-2">
                                ✓ File Tersedia untuk diunduh
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Related Games -->
            @if ($game->categories->count())
                <div class="mt-12">
                    <h3 class="text-2xl font-bold mb-6">Game Terkait</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @php
                            $relatedGames = \App\Models\Game::whereHas('categories', function ($query) use ($game) {
                                $query->whereIn('category_id', $game->categories->pluck('id'));
                            })
                                ->where('id', '!=', $game->id)
                                ->where('status', 'published')
                                ->limit(3)
                                ->get();
                        @endphp

                        @forelse ($relatedGames as $related)
                            <a href="{{ route('game.show', $related) }}"
                                class="bg-white rounded-lg overflow-hidden shadow hover:shadow-lg transition">
                                <img src="{{ $related->cover_url }}" alt="{{ $related->title }}"
                                    class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h4 class="font-semibold">{{ $related->title }}</h4>
                                    <p class="text-green-600 font-bold mt-2">
                                        Rp {{ number_format($related->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </a>
                        @empty
                        @endforelse
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
