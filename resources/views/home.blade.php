<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Ini Home Page, Khusus (Role: {{ Auth::user()->role }})</h1>
                </div>
            </div>
        </div>
    </div>

    @if (isset($games) && $games->count())
        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-6">
                    <h2 class="font-bold mb-4">Katalog Game</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($games as $game)
                            <div class="border rounded-lg p-4 flex flex-col">
                                <img src="{{ $game->cover_url }}" alt="{{ $game->title }}"
                                    class="h-40 w-full object-cover mb-3">
                                <h3 class="font-semibold text-lg">{{ $game->title }}</h3>
                                <p class="text-sm text-gray-600 mb-2">
                                    {{ Str::limit($game->description, 100) }}
                                </p>
                                <p class="font-bold mb-2">Rp {{ number_format($game->price, 0, ',', '.') }}</p>
                                @if (in_array($game->id, $wishlistGameIds))
                                    <form action="{{ route('wishlist.destroy', $game) }}" method="POST" class="mb-2">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:underline">Remove from Wishlist</button>
                                    </form>
                                @else
                                    <form action="{{ route('wishlist.store', $game) }}" method="POST" class="mb-2">
                                        @csrf
                                        <button class="text-blue-600 hover:underline">Add to Wishlist</button>
                                    </form>
                                @endif
                                @if ($game->package)
                                    <a href="{{ route('game.download', $game) }}"
                                        class="mt-auto text-green-600 hover:underline">Download</a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>Belum ada game yang tersedia.</p>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
