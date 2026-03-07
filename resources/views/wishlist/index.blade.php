<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                {{ __('Wishlist Saya') }}
            </h2>
            <span class="px-3 py-1 bg-[#2a2a2a] text-gray-300 text-xs font-medium rounded-sm border border-gray-700">
                {{ $wishlistGames->count() }} Game
            </span>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen bg-[#121212]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Success Message (Dark Style) -->
            @if (session('success'))
                <div
                    class="mb-6 p-4 bg-green-900/50 border border-green-700 text-green-300 rounded-sm flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if ($wishlistGames->count())
                <!-- Grid Layout: Landscape cards like catalog -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($wishlistGames as $game)
                        <div
                            class="group relative bg-[#1f1f1f] rounded-sm overflow-hidden hover:shadow-xl hover:shadow-black/50 transition-all duration-300 flex flex-col h-full border border-gray-800">

                            <!-- Image Area (Landscape 16:9) -->
                            <div class="relative aspect-video overflow-hidden">
                                <img src="{{ $game->cover_url }}" alt="{{ $game->title }}"
                                    class="h-full w-full object-cover transform group-hover:scale-105 transition duration-500">



                                <!-- Remove Button (Top Right) -->
                                <div class="absolute top-3 right-3 z-10">
                                    <form action="{{ route('wishlist.destroy', $game) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-black/70 hover:bg-red-600 text-white p-2 rounded-sm backdrop-blur-sm transition border border-gray-600 hover:border-red-600"
                                            title="Hapus dari Wishlist"
                                            onclick="return confirm('Hapus game ini dari wishlist?')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Content Area -->
                            <div class="p-4 flex flex-col flex-grow">
                                <div class="flex-grow">
                                    <h3 class="font-bold text-white text-lg leading-tight mb-2 line-clamp-1"
                                        title="{{ $game->title }}">
                                        {{ $game->title }}
                                    </h3>
                                    <p class="text-xs text-gray-400 mb-3 line-clamp-2">
                                        {{ Str::limit($game->description, 70) }}
                                    </p>
                                </div>

                                <div class="space-y-3 pt-2 border-t border-gray-800">
                                    <!-- Price -->
                                    <div class="flex items-center justify-between">
                                        <span class="text-white font-bold text-lg">Rp
                                            {{ number_format($game->price, 0, ',', '.') }}</span>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex gap-2">
                                        <a href="{{ route('game.show', $game) }}"
                                            class="flex-1 text-center px-3 py-2 bg-white text-black text-sm font-bold rounded-sm hover:bg-gray-200 transition uppercase tracking-wide">
                                            Detail
                                        </a>
                                        <form action="{{ route('cart.add', $game) }}" method="POST" class="flex-1">
                                            @csrf
                                            <button type="submit"
                                                class="w-full px-3 py-2 bg-[#2a2a2a] text-white text-sm font-medium rounded-sm hover:bg-[#3a3a3a] border border-gray-600 transition">
                                                Beli
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State (Epic Style) -->
                <div class="bg-[#1f1f1f] border border-gray-800 rounded-sm overflow-hidden">
                    <div class="p-12 text-center">
                        <!-- Empty Icon -->
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-[#2a2a2a] mb-6">
                            <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-white mb-2">Wishlist Anda Kosong</h3>
                        <p class="text-gray-400 mb-6 max-w-md mx-auto">
                            Belum ada game yang Anda tambahkan ke wishlist. Jelajahi katalog untuk menemukan game
                            favorit Anda!
                        </p>

                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-6 py-3 bg-white text-black font-bold rounded-sm hover:bg-gray-200 transition uppercase tracking-wide">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Jelajahi Game
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
