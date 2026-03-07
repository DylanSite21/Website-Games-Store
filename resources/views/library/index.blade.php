<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                {{ __('Perpustakaan Game Saya') }}
            </h2>
            <span class="px-3 py-1 bg-[#2a2a2a] text-gray-300 text-xs font-medium rounded-sm border border-gray-700">
                {{ $purchasedGames->count() }} Game Dimiliki
            </span>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen bg-[#121212]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if ($purchasedGames->count())
                <!-- Info Banner -->
                <div class="mb-6 p-4 bg-[#1f1f1f] border border-gray-800 rounded-sm flex items-center gap-3">
                    <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <p class="text-gray-300 text-sm">
                        Anda telah membeli <strong class="text-white">{{ $purchasedGames->count() }} game</strong>. Game
                        dapat diakses kapan saja.
                    </p>
                </div>

                <!-- Games Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($purchasedGames as $game)
                        <div
                            class="group relative bg-[#1f1f1f] rounded-sm overflow-hidden hover:shadow-xl hover:shadow-black/50 transition-all duration-300 flex flex-col h-full border border-gray-800">

                            <!-- Image Area (Landscape 16:9) -->
                            <div class="relative aspect-video overflow-hidden">
                                <img src="{{ $game->cover_url }}" alt="{{ $game->title }}"
                                    class="h-full w-full object-cover transform group-hover:scale-105 transition duration-500">

                                <!-- Owned Badge -->
                                <div class="absolute top-3 left-3 z-10">
                                    <span
                                        class="px-2 py-1 bg-green-600/90 backdrop-blur-sm text-xs font-bold rounded-sm text-white flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Dimiliki
                                    </span>
                                </div>
                            </div>

                            <!-- Content Area -->
                            <div class="p-4 flex flex-col flex-grow">
                                <div class="flex-grow">
                                    <h3 class="font-bold text-white text-lg leading-tight mb-2 line-clamp-1"
                                        title="{{ $game->title }}">
                                        {{ $game->title }}
                                    </h3>
                                    <p class="text-xs text-gray-400 mb-4 line-clamp-2">
                                        {{ Str::limit($game->description, 70) }}
                                    </p>
                                </div>

                                <div class="space-y-2 pt-2 border-t border-gray-800">
                                    <!-- Action Buttons -->
                                    <div class="flex flex-col gap-2">
                                        @if ($game->package)
                                            <a href="{{ route('game.download', $game) }}"
                                                class="w-full text-center px-3 py-2 bg-white text-black text-sm font-bold rounded-sm hover:bg-gray-200 transition uppercase tracking-wide flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4">
                                                    </path>
                                                </svg>
                                                Download
                                            </a>
                                        @else
                                            <button disabled
                                                class="w-full text-center px-3 py-2 bg-[#2a2a2a] text-gray-500 text-sm font-medium rounded-sm cursor-not-allowed border border-gray-700 flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                Belum Tersedia
                                            </button>
                                        @endif

                                        <a href="{{ route('game.show', $game) }}"
                                            class="w-full text-center px-3 py-2 bg-[#2a2a2a] text-white text-sm font-medium rounded-sm hover:bg-[#3a3a3a] border border-gray-600 transition flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                            Detail Game
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty Library State (Epic Style) -->
                <div class="bg-[#1f1f1f] border border-gray-800 rounded-sm overflow-hidden">
                    <div class="p-12 text-center">
                        <!-- Empty Library Icon -->
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-[#2a2a2a] mb-6">
                            <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-white mb-2">Perpustakaan Kosong</h3>
                        <p class="text-gray-400 mb-6 max-w-md mx-auto">
                            Anda belum membeli game apapun. Jelajahi katalog kami untuk menemukan game terbaik dan mulai
                            koleksi Anda!
                        </p>

                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-6 py-3 bg-white text-black font-bold rounded-sm hover:bg-gray-200 transition uppercase tracking-wide">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Jelajahi Katalog
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
