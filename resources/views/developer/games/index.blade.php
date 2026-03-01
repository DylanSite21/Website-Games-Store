<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Game') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('developer.games.create') }}" class="px-4 py-2 bg-green-600 text-white rounded">Buat
                    Game Baru</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    @if (session('success'))
                        <div class="mb-4 text-green-600">{{ session('success') }}</div>
                    @endif
                    @if ($games->count())
                        <table class="w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">Judul</th>
                                    <th class="border px-4 py-2">Status</th>
                                    <th class="border px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($games as $game)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $game->title }}</td>
                                        <td class="border px-4 py-2">{{ $game->status }}</td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('developer.games.edit', $game) }}"
                                                class="text-blue-600 hover:underline">Edit</a>
                                            <form action="{{ route('developer.games.destroy', $game) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600 hover:underline"
                                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Tidak ada game yang dibuat.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
