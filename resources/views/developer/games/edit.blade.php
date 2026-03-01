<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Game') }}
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white">
                <form action="{{ route('developer.games.update', $game) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block">Judul</label>
                        <input type="text" name="title" value="{{ old('title', $game->title) }}"
                            class="w-full border rounded px-2 py-1">
                        @error('title')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block">Deskripsi</label>
                        <textarea name="description" class="w-full border rounded px-2 py-1">{{ old('description', $game->description) }}</textarea>
                        @error('description')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block">Harga</label>
                        <input type="number" name="price" step="0.01" value="{{ old('price', $game->price) }}"
                            class="w-full border rounded px-2 py-1">
                        @error('price')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block">Cover Image</label>
                        <input type="file" name="cover_image" class="w-full">
                        @if ($game->cover_image)
                            <p class="text-sm">Saat ini: <img src="{{ $game->cover_url }}" class="h-16"></p>
                        @endif
                        @error('cover_image')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block">Video Trailer (URL)</label>
                        <input type="text" name="video_trailer"
                            value="{{ old('video_trailer', $game->video_trailer) }}"
                            class="w-full border rounded px-2 py-1">
                        @error('video_trailer')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block">File Game (zip/exe)</label>
                        <input type="file" name="package" class="w-full">
                        @if ($game->package)
                            <p class="text-sm">Saat ini: <a href="{{ route('game.download', $game) }}"
                                    class="text-green-600">Download</a></p>
                        @endif
                        @error('package')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block">Status</label>
                        <select name="status" class="w-full border rounded px-2 py-1">
                            <option value="draft" {{ $game->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ $game->status == 'published' ? 'selected' : '' }}>Published
                            </option>
                            <option value="rejected" {{ $game->status == 'rejected' ? 'selected' : '' }}>Rejected
                            </option>
                        </select>
                        @error('status')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block">Kategori</label>
                        <div class="space-y-1">
                            @foreach ($categories as $category)
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        class="form-checkbox"
                                        {{ in_array($category->id, $game->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                                    <span class="ml-2">{{ $category->name }}</span>
                                </label><br>
                            @endforeach
                        </div>
                        @error('categories')
                            <div class="text-red-600">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
