<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Kategori') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('developer.categories.create') }}"
                    class="px-4 py-2 bg-green-600 text-white rounded">Tambah Kategori</a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    @if (session('success'))
                        <div class="mb-4 text-green-600">{{ session('success') }}</div>
                    @endif

                    @if ($categories->count())
                        <table class="w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="border px-4 py-2">Nama</th>
                                    <th class="border px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $category->name }}</td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('developer.categories.edit', $category) }}"
                                                class="text-blue-600 hover:underline">Edit</a>
                                            <form action="{{ route('developer.categories.destroy', $category) }}"
                                                method="POST" class="inline">
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
                        <p>Belum ada kategori.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
