<x-app-layout>
    <x-slot name="header">
        <h2 class=" font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    {{-- Corousel --}}
    <x-corousel :corousel="$corousel ?? collect()" />

    {{-- Corousel End --}}


    <div class="">
        <div class="w-full    ">
            <div class="bg-black/80 overflow-hidden shadow-sm  backdrop-blur-20">
                <div class="text-xm p-6 text-white">
                    <h1>Ini Home Page, Khusus (Role: {{ Auth::user()->role }})</h1>
                    <p class="text-gray-500">Akun : {{ Auth::user()->name }}</p>
                </div>
            </div>
        </div>
    </div>




    {{-- Main Content --}}
    @if (isset($games))
        <div class="min-h-screen bg-[#121212] py-8">
            <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Header & Search -->
                <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
                    <h2 class="text-3xl font-bold text-white tracking-tight">Katalog Game</h2>
                    <form action="{{ route('home') }}" method="GET" class="relative w-full md:w-96">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari game..."
                            class="w-full bg-[#2a2a2a] text-white border-none rounded-sm px-4 py-3 focus:ring-2 focus:ring-white focus:outline-none placeholder-gray-400 transition" />
                        <button type="submit"
                            class="absolute right-2 top-2 bg-black text-white px-4 py-1.5 rounded-sm text-sm font-bold hover:bg-gray-700 transition">
                            Search
                        </button>
                    </form>
                </div>

                @if ($games->count())
                    <!-- Grid Layout: Disesuaikan untuk rasio landscape (lebih sedikit kolom agar tidak sempit) -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach ($games as $game)
                            <div
                                class="group relative bg-[#1f1f1f] rounded-sm overflow-hidden hover:shadow-xl hover:shadow-black/50 transition-all duration-300 flex flex-col h-full">

                                <!-- Image Area (Landscape 16:9) -->
                                <div class="relative aspect-video overflow-hidden">
                                    <img src="{{ $game->cover_url }}" alt="{{ $game->title }}"
                                        class="h-full w-full object-cover transform group-hover:scale-105 transition duration-500">

                                    <!-- Wishlist Button (Absolute Position) -->
                                    <div class="absolute top-2 right-2 z-10">
                                        @if (in_array($game->id, $wishlistGameIds))
                                            <form action="{{ route('wishlist.destroy', $game) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-[#121212]/80 hover:bg-red-600 text-white p-2 rounded-full backdrop-blur-sm transition border border-gray-600 hover:border-red-600"
                                                    title="Hapus dari Wishlist">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="white" stroke="white"
                                                        stroke-width="2" stroke-linecap="square"
                                                        stroke-linejoin="round">
                                                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('wishlist.store', $game) }}" method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="bg-[#121212]/80 hover:bg-white hover:text-black text-white p-2 rounded-full backdrop-blur-sm transition border border-gray-600 hover:border-white"
                                                    title="Tambah ke Wishlist">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="square"
                                                        stroke-linejoin="round">
                                                        <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>

                                <!-- Content Area -->
                                <div class="p-4 flex flex-col flex-grow justify-between">
                                    <div>
                                        <h3 class="font-bold text-white text-lg leading-tight mb-2 line-clamp-1"
                                            title="{{ $game->title }}">
                                            {{ $game->title }}
                                        </h3>
                                        <p class="text-xs text-gray-400 mb-4 line-clamp-2">
                                            {{ Str::limit($game->description, 80) }}
                                        </p>
                                    </div>

                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-white font-bold text-lg">Rp
                                                {{ number_format($game->price, 0, ',', '.') }}</span>
                                        </div>

                                        <!-- Add to Cart Button (Epic Style: White BG, Black Text) -->
                                        <form action="{{ route('cart.add', $game) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="w-full bg-white text-black text-sm font-bold py-3 px-3 rounded-sm hover:bg-gray-200 transition uppercase tracking-wide">
                                                Tambah ke Keranjang
                                            </button>
                                        </form>

                                        <!-- Detail Link -->
                                        <a href="{{ route('game.show', $game) }}"
                                            class="block text-center text-xs text-gray-400 hover:text-white hover:underline">
                                            Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-20">
                        <p class="text-gray-400 text-lg">Belum ada game yang tersedia di katalog.</p>
                    </div>
                @endif
            </div>
        </div>
    @else
        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>Data game tidak ditemukan.</p>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
