<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                {{ __('Keranjang Belanja') }}
            </h2>
            <span class="px-3 py-1 bg-[#2a2a2a] text-gray-300 text-xs font-medium rounded-sm border border-gray-700">
                {{ $cartItems->count() }} Item
            </span>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen bg-[#121212]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Success Message (Dark Style) -->
            @if (session('success'))
                <div
                    class="mb-6 p-4 bg-green-900/50 border border-green-700 text-green-300 rounded-sm flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if ($cartItems->count())
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Cart Items (Left Column) -->
                    <div class="lg:col-span-2">
                        <div class="bg-[#1f1f1f] border border-gray-800 rounded-sm overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-6">
                                    <h3 class="font-bold text-lg text-white">
                                        {{ $cartItems->count() }} Item di Keranjang
                                    </h3>
                                    <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 bg-[#2a2a2a] text-gray-300 text-sm font-medium rounded-sm hover:bg-red-600 hover:text-white border border-gray-600 hover:border-red-600 transition"
                                            onclick="return confirm('Yakin ingin mengosongkan keranjang?')">
                                            <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Kosongkan Semua
                                        </button>
                                    </form>
                                </div>

                                <div class="space-y-4">
                                    @foreach ($cartItems as $item)
                                        <div
                                            class="flex gap-4 p-4 bg-[#121212] rounded-sm border border-gray-800 hover:border-gray-700 transition">
                                            <!-- Game Cover -->
                                            <div class="flex-shrink-0">
                                                <img src="{{ $item->game->cover_url }}" alt="{{ $item->game->title }}"
                                                    class="w-32 h-20 object-cover rounded-sm">
                                            </div>

                                            <!-- Game Info -->
                                            <div class="flex-1 min-w-0">
                                                <h4
                                                    class="font-bold text-white text-lg leading-tight mb-1 line-clamp-1">
                                                    {{ $item->game->title }}
                                                </h4>
                                                <p class="text-xs text-gray-400 mb-2 line-clamp-2">
                                                    {{ Str::limit($item->game->description, 80) }}
                                                </p>
                                                <p class="font-bold text-white text-lg">
                                                    Rp {{ number_format($item->game->price, 0, ',', '.') }}
                                                </p>
                                            </div>

                                            <!-- Remove Button -->
                                            <div class="flex-shrink-0">
                                                <form action="{{ route('cart.remove', $item->game) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-600/10 rounded-sm transition"
                                                        title="Hapus dari keranjang"
                                                        onclick="return confirm('Hapus item ini dari keranjang?')">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary (Right Column - Sticky) -->
                    <div class="lg:col-span-1">
                        <div class="bg-[#1f1f1f] border border-gray-800 rounded-sm overflow-hidden">
                            <div class="p-6">
                                <h3 class="font-bold text-lg text-white mb-6 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Ringkasan Pesanan
                                </h3>

                                <div class="space-y-3 mb-6">
                                    <div class="flex justify-between text-gray-300">
                                        <span>Subtotal ({{ $cartItems->count() }} item)</span>
                                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-gray-300">
                                        <span>Pajak</span>
                                        <span class="text-green-400">Rp 0</span>
                                    </div>
                                    <div class="flex justify-between text-gray-300">
                                        <span>Ongkir</span>
                                        <span class="text-green-400">Gratis</span>
                                    </div>

                                    <!-- Discount Section (Optional) -->
                                    @if (session('discount') ?? 0 > 0)
                                        <div class="flex justify-between text-green-400">
                                            <span>Diskon</span>
                                            <span>-Rp {{ number_format(session('discount'), 0, ',', '.') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Total -->
                                <div class="border-t border-gray-700 pt-4 mb-6">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-300 font-medium">Total</span>
                                        <span class="text-2xl font-bold text-white">Rp
                                            {{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <!-- Checkout Button -->
                                <a href="{{ route('payment.checkout') }}"
                                    class="w-full block text-center px-4 py-3 bg-white text-black font-bold rounded-sm hover:bg-gray-200 transition uppercase tracking-wide mb-3">
                                    Lanjut ke Pembayaran
                                </a>

                                <!-- Trust Badges -->
                                <div class="flex items-center justify-center gap-4 text-xs text-gray-500">
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                            </path>
                                        </svg>
                                        <span>Aman</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                            </path>
                                        </svg>
                                        <span>Terpercaya</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Support Card -->
                        <div class="bg-[#1f1f1f] border border-gray-800 rounded-sm overflow-hidden mt-6 p-6">
                            <h4 class="font-bold text-white mb-3 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                                    </path>
                                </svg>
                                Butuh Bantuan?
                            </h4>
                            <p class="text-sm text-gray-400 mb-4">
                                Ada pertanyaan tentang pesanan Anda? Tim support kami siap membantu.
                            </p>
                            <a href="#" class="text-sm text-blue-400 hover:text-blue-300 hover:underline">
                                Hubungi Support →
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart State (Epic Style) -->
                <div class="bg-[#1f1f1f] border border-gray-800 rounded-sm overflow-hidden">
                    <div class="p-12 text-center">
                        <!-- Empty Cart Icon -->
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-[#2a2a2a] mb-6">
                            <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-white mb-2">Keranjang Anda Kosong</h3>
                        <p class="text-gray-400 mb-6 max-w-md mx-auto">
                            Belum ada game di keranjang Anda. Jelajahi katalog untuk menemukan game favorit dan
                            tambahkan ke keranjang!
                        </p>

                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-6 py-3 bg-white text-black font-bold rounded-sm hover:bg-gray-200 transition uppercase tracking-wide">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Lanjutkan Belanja
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
