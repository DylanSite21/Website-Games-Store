<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Perpustakaan Game Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($purchasedGames->count())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <p class="text-gray-600">
                            Anda telah membeli <strong>{{ $purchasedGames->count() }} game</strong>.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($purchasedGames as $game)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
                            <div class="bg-gray-100 h-40 overflow-hidden">
                                <img src="{{ $game->cover_url }}" alt="{{ $game->title }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div class="p-4">
                                <h3 class="font-semibold text-lg mb-2">{{ $game->title }}</h3>
                                <p class="text-sm text-gray-600 mb-3">
                                    {{ Str::limit($game->description, 80) }}
                                </p>

                                <div class="flex gap-2">
                                    @if ($game->package)
                                        <a href="{{ route('game.download', $game) }}"
                                            class="flex-1 text-center px-3 py-2 bg-green-600 text-white rounded hover:bg-green-700 text-sm font-bold">
                                            Download
                                        </a>
                                    @endif
                                    <a href="{{ route('game.show', $game) }}"
                                        class="flex-1 text-center px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm font-bold">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p class="mb-4">Anda belum membeli game apapun.</p>
                        <a href="{{ route('home') }}" class="text-blue-600 hover:underline">
                            Jelajahi katalog dan mulai belanja
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
