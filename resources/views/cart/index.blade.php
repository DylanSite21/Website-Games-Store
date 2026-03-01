<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang Belanja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($cartItems->count())
                <div class="grid grid-cols-3 gap-6">
                    <!-- Cart Items -->
                    <div class="col-span-2">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h3 class="font-bold text-lg mb-4">{{ $cartItems->count() }} Item di Keranjang</h3>
                                <div class="space-y-4">
                                    @foreach ($cartItems as $item)
                                        <div class="flex justify-between items-center border-b pb-4">
                                            <div class="flex gap-4 flex-1">
                                                <img src="{{ $item->game->cover_url }}" alt="{{ $item->game->title }}"
                                                    class="w-24 h-32 object-cover rounded">
                                                <div>
                                                    <h4 class="font-semibold">{{ $item->game->title }}</h4>
                                                    <p class="text-sm text-gray-600">
                                                        {{ Str::limit($item->game->description, 60) }}
                                                    </p>
                                                    <p class="font-bold text-lg mt-2">
                                                        Rp {{ number_format($item->game->price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <form action="{{ route('cart.remove', $item->game) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-6">
                                    <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="px-3 py-1 bg-gray-400 text-white rounded hover:bg-gray-500 text-sm">
                                            Kosongkan Keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary -->
                    <div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg sticky top-24">
                            <div class="p-6">
                                <h3 class="font-bold text-lg mb-4">Ringkasan Pesanan</h3>
                                <div class="space-y-2 mb-4">
                                    <div class="flex justify-between">
                                        <span>Subtotal</span>
                                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Pajak</span>
                                        <span>Rp 0</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Ongkir</span>
                                        <span>Gratis</span>
                                    </div>
                                </div>
                                <div class="border-t pt-4 font-bold text-lg flex justify-between mb-6">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('payment.checkout') }}"
                                    class="w-full block text-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Lanjut ke Pembayaran
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p class="mb-4">Keranjang Anda kosong.</p>
                        <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Lanjutkan Belanja</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
