<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-white leading-tight tracking-tight line-clamp-1">
                {{ $game->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen bg-[#121212]">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Main Game Card -->
            <div class="bg-[#1f1f1f] border border-gray-800 rounded-sm overflow-hidden shadow-xl">
                <div class="grid md:grid-cols-2 gap-0">
                    
                    <!-- Left: Image & Media -->
                    <div class="p-6 bg-[#121212]">
                        <!-- Main Cover -->
                        <div class="rounded-sm overflow-hidden mb-4 shadow-lg">
                            <img src="{{ $game->cover_url }}" alt="{{ $game->title }}" 
                                class="w-full h-80 object-cover transform hover:scale-105 transition duration-500">
                        </div>

                        <!-- Video Trailer -->
                        @if ($game->youtube_embed)
                            <div>
                                <p class="text-sm text-gray-400 mb-2 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Video Trailer
                                </p>
                                <div class="rounded-sm overflow-hidden shadow-lg aspect-video">
                                    <iframe width="100%" height="100%" src="{{ $game->youtube_embed }}" 
                                        frameborder="0" allowfullscreen class="w-full h-full">
                                    </iframe>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Right: Game Details -->
                    <div class="p-8 flex flex-col">
                        <!-- Title -->
                        <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-3 leading-tight">
                            {{ $game->title }}
                        </h1>

                        <!-- Developer -->
                        <div class="flex items-center gap-2 mb-4">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <p class="text-gray-400 text-sm">
                                Oleh <span class="text-white font-medium hover:underline cursor-pointer">{{ $game->developer->name }}</span>
                            </p>
                        </div>

                        <!-- Categories -->
                        @if ($game->categories->count())
                            <div class="mb-6">
                                <p class="text-xs text-gray-500 uppercase tracking-wider mb-2">Kategori</p>
                                <div class="flex gap-2 flex-wrap">
                                    @foreach ($game->categories as $category)
                                        <span class="bg-[#2a2a2a] text-gray-300 px-3 py-1 rounded-sm text-xs font-medium border border-gray-700 hover:border-gray-500 transition">
                                            {{ $category->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Price -->
                        <div class="mb-6 p-4 bg-[#121212] rounded-sm border border-gray-800">
                            @if ($game->price > 0)
                                <div class="flex items-baseline gap-3">
                                    <p class="text-4xl font-bold text-white">
                                        Rp {{ number_format($game->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            @else
                                <p class="text-3xl font-bold text-green-400 flex items-center gap-2">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    GRATIS
                                </p>
                            @endif
                        </div>

                        <!-- Description -->
                        <div class="mb-6 flex-grow">
                            <h3 class="font-bold text-white text-lg mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Deskripsi
                            </h3>
                            <p class="text-gray-400 leading-relaxed text-sm">
                                {{ $game->description }}
                            </p>
                        </div>

                        <!-- Status Badge -->
                        <div class="mb-6 p-3 bg-[#121212] rounded-sm border border-gray-800">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Status</p>
                                <span class="px-2 py-1 bg-green-600/20 text-green-400 text-xs font-bold rounded-sm border border-green-600/30">
                                    {{ ucfirst($game->status) }}
                                </span>
                            </div>
                            @if ($game->package)
                                <div class="flex items-center gap-2 text-green-400 text-xs">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>File Tersedia untuk Diunduh</span>
                                </div>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3">
                            @if (auth()->check())
                                <form action="{{ route('cart.add', $game) }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit"
                                        class="w-full px-6 py-4 bg-white text-black rounded-sm hover:bg-gray-200 font-bold text-base transition uppercase tracking-wide flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        Tambahkan ke Keranjang
                                    </button>
                                </form>

                                <form action="{{ route('wishlist.store', $game) }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit"
                                        class="w-full px-6 py-3 bg-[#2a2a2a] text-white rounded-sm hover:bg-[#3a3a3a] font-medium text-sm transition border border-gray-700 flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                        Tambahkan ke Wishlist
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}"
                                    class="block text-center px-6 py-4 bg-white text-black rounded-sm hover:bg-gray-200 font-bold text-base transition uppercase tracking-wide flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Login untuk Membeli
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Games -->
            @if ($game->categories->count())
                <div class="mt-12">
                    <h3 class="text-2xl font-bold text-white mb-6 flex items-center gap-3">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                        Game Terkait
                    </h3>
                    
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
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <a href="{{ route('game.show', $related) }}" 
                                class="group relative bg-[#1f1f1f] rounded-sm overflow-hidden hover:shadow-xl hover:shadow-black/50 transition-all duration-300 border border-gray-800">
                                <!-- Image -->
                                <div class="aspect-video overflow-hidden">
                                    <img src="{{ $related->cover_url }}" alt="{{ $related->title }}"
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                                </div>
                                <!-- Content -->
                                <div class="p-4">
                                    <h4 class="font-bold text-white text-base mb-2 line-clamp-1">{{ $related->title }}</h4>
                                    <p class="text-white font-bold text-lg">
                                        @if ($related->price > 0)
                                            Rp {{ number_format($related->price, 0, ',', '.') }}
                                        @else
                                            <span class="text-green-400">GRATIS</span>
                                        @endif
                                    </p>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="bg-[#1f1f1f] border border-gray-800 rounded-sm p-8 text-center">
                            <p class="text-gray-400">Tidak ada game terkait yang ditemukan.</p>
                        </div>
                    @endforelse
                </div>
            @endif
        </div>
    </div>
</x-app-layout>