<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1>Developer Dashboard (Role: {{ Auth::user()->role }})</h1>
                    <p class="mt-2">
                        <a href="{{ route('developer.games.index') }}" class="text-blue-600 hover:underline">Kelola
                            Game</a> |
                        <a href="{{ route('developer.categories.index') }}" class="text-blue-600 hover:underline">Kelola
                            Kategori</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if (isset($games) && $games->count())
        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-bold mb-4">Game yang Sudah Dibuat</h2>
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2 text-left">Judul</th>
                                <th class="border px-4 py-2 text-left">Status</th>
                                <th class="border px-4 py-2 text-left">Harga</th>
                                <th class="border px-4 py-2 text-left">Dibuat</th>
                                <th class="border px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($games as $game)
                                <tr>
                                    <td class="border px-4 py-2">{{ $game->title }}</td>
                                    <td class="border px-4 py-2">{{ ucfirst($game->status) }}</td>
                                    <td class="border px-4 py-2">Rp {{ number_format($game->price, 0, ',', '.') }}</td>
                                    <td class="border px-4 py-2">{{ $game->created_at->format('Y-m-d') }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <a href="{{ route('developer.games.edit', $game) }}"
                                            class="text-blue-600 hover:underline">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p>Belum ada game yang dibuat. <a href="{{ route('developer.games.create') }}"
                            class="text-blue-600 hover:underline">Buat Game Baru</a></p>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
