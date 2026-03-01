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

    @if (isset($files) && $files->count())
        <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-bold mb-4">Daftar File yang Diunggah oleh Developer</h2>
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2 text-left">Judul</th>
                                <th class="border px-4 py-2 text-left">Waktu</th>
                                <th class="border px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                                <tr>
                                    <td class="border px-4 py-2">{{ $file->title }}</td>
                                    <td class="border px-4 py-2">{{ $file->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="border px-4 py-2 text-center">
                                        <a href="{{ route('file.download', $file->id) }}"
                                            class="text-blue-600 hover:underline">Download</a>
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
                    <p>Belum ada file yang diupload oleh developer.</p>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
