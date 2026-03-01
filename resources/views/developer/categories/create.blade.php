<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kategori') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white">
                <form action="{{ route('developer.categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block">Nama</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border rounded px-2 py-1">
                        @error('name')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
