<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wishlist Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($wishlistGames->count())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 space-y-6">
                        <h2 class="font-bold text-lg">Game di Wishlist Saya</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($wishlistGames as $game)
                                <div class="border rounded-lg p-4 flex flex-col shadow-sm hover:shadow-md transition">
                                    <img src="{{ $game->cover_url }}" alt="{{ $game->title }}"
                                        class="h-40 w-full object-cover mb-3 rounded">
                                    <h3 class="font-semibold text-lg">{{ $game->title }}</h3>
                                    <p class="text-sm text-gray-600 mb-2">
                                        {{ Str::limit($game->description, 80) }}
                                    </p>
                                    <p class="font-bold text-lg mb-2">Rp {{ number_format($game->price, 0, ',', '.') }}
                                    </p>
                                    <div class="text-sm text-gray-500 mb-3">
                                        Status: <span class="font-semibold">{{ ucfirst($game->status) }}</span>
                                    </div>

                                    <div class="mt-auto flex gap-2">
                                        <a href="{{ route('game.show', $game) }}"
                                            class="flex-1 text-center px-3 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 text-sm">
                                            Detail
                                        </a>
                                        <form action="{{ route('wishlist.destroy', $game) }}" method="POST"
                                            class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="w-full px-3 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p class="mb-4">Wishlist Anda kosong. </p>
                        <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Jelajahi Game</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
