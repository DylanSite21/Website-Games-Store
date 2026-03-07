<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('cart.index') }}" class="text-gray-400 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                {{ __('Checkout') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen bg-[#121212]">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Success/Error Messages -->
            @if (session('success'))
                <div
                    class="mb-6 p-4 bg-green-900/50 border border-green-700 text-green-300 rounded-sm flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-6 p-4 bg-red-900/50 border border-red-700 text-red-300 rounded-sm flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-6">

                <!-- Left: Payment & Billing Info -->
                <div class="bg-[#1f1f1f] border border-gray-800 rounded-sm overflow-hidden">
                    <div class="p-6">
                        <!-- Buyer Information -->
                        <div class="mb-6">
                            <h3 class="font-bold text-lg text-white mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Informasi Pembeli
                            </h3>

                            <div class="space-y-4 p-4 bg-[#121212] rounded-sm border border-gray-800">
                                <div>
                                    <label class="text-xs text-gray-500 uppercase tracking-wider">Nama Lengkap</label>
                                    <p class="text-white font-medium mt-1">{{ Auth::user()->name }}</p>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 uppercase tracking-wider">Email</label>
                                    <p class="text-white font-medium mt-1">{{ Auth::user()->email }}</p>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-500 uppercase tracking-wider">ID User</label>
                                    <p class="text-gray-400 font-mono text-sm mt-1">#{{ Auth::user()->id }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Methods -->
                        <div>
                            <h3 class="font-bold text-lg text-white mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                    </path>
                                </svg>
                                Metode Pembayaran
                            </h3>

                            <div class="space-y-2">
                                <!-- Indomaret / Alfamart -->
                                <label
                                    class="flex items-center p-4 bg-[#121212] rounded-sm border border-gray-800 cursor-pointer hover:border-gray-600 transition">
                                    <input type="radio" name="payment_method" value="indomaret" checked
                                        class="w-4 h-4 text-blue-600 bg-[#1f1f1f] border-gray-600 focus:ring-blue-500 focus:ring-2">
                                    <div class="ml-3 flex-1">
                                        <span class="text-white font-medium block">Indomaret / Alfamart</span>
                                        <span class="text-xs text-gray-500">Bayar di toko terdekat</span>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </label>

                                <!-- Bank Transfer -->
                                <label
                                    class="flex items-center p-4 bg-[#121212] rounded-sm border border-gray-800 cursor-pointer hover:border-gray-600 transition">
                                    <input type="radio" name="payment_method" value="bank_transfer"
                                        class="w-4 h-4 text-blue-600 bg-[#1f1f1f] border-gray-600 focus:ring-blue-500 focus:ring-2">
                                    <div class="ml-3 flex-1">
                                        <span class="text-white font-medium block">Transfer Bank</span>
                                        <span class="text-xs text-gray-500">BCA, Mandiri, BNI, BRI</span>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                    </svg>
                                </label>

                                <!-- Credit Card -->
                                <label
                                    class="flex items-center p-4 bg-[#121212] rounded-sm border border-gray-800 cursor-pointer hover:border-gray-600 transition">
                                    <input type="radio" name="payment_method" value="credit_card"
                                        class="w-4 h-4 text-blue-600 bg-[#1f1f1f] border-gray-600 focus:ring-blue-500 focus:ring-2">
                                    <div class="ml-3 flex-1">
                                        <span class="text-white font-medium block">Kartu Kredit</span>
                                        <span class="text-xs text-gray-500">Visa, Mastercard, JCB</span>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                        </path>
                                    </svg>
                                </label>

                                <!-- E-Wallet -->
                                <label
                                    class="flex items-center p-4 bg-[#121212] rounded-sm border border-gray-800 cursor-pointer hover:border-gray-600 transition">
                                    <input type="radio" name="payment_method" value="ewallet"
                                        class="w-4 h-4 text-blue-600 bg-[#1f1f1f] border-gray-600 focus:ring-blue-500 focus:ring-2">
                                    <div class="ml-3 flex-1">
                                        <span class="text-white font-medium block">E-Wallet</span>
                                        <span class="text-xs text-gray-500">GoPay, OVO, Dana, ShopeePay</span>
                                    </div>
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </label>
                            </div>
                        </div>

                        <!-- Info Notice -->
                        <div class="mt-6 p-4 bg-blue-900/30 border border-blue-700/50 rounded-sm">
                            <div class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-blue-400 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm text-gray-300">
                                    <strong class="text-white">Catatan:</strong> Sistem pembayaran sedang dalam mode
                                    simulasi. Setelah klik "Bayar Sekarang", pesanan akan langsung diproses sebagai
                                    <span class="text-green-400 font-semibold">PAID</span> untuk demo purposes.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Order Summary -->
                <div>
                    <div class="bg-[#1f1f1f] border border-gray-800 rounded-sm overflow-hidden mb-6 sticky top-24">
                        <div class="p-6">
                            <h3 class="font-bold text-lg text-white mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Ringkasan Pesanan
                            </h3>

                            <!-- Cart Items List -->
                            <div class="space-y-3 mb-4 max-h-60 overflow-y-auto pr-2 custom-scrollbar">
                                @foreach ($cartItems as $item)
                                    <div class="flex gap-3 p-3 bg-[#121212] rounded-sm border border-gray-800">
                                        <img src="{{ $item->game->cover_url }}" alt="{{ $item->game->title }}"
                                            class="w-16 h-10 object-cover rounded-sm flex-shrink-0">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-white text-sm font-medium line-clamp-1">
                                                {{ $item->game->title }}</p>
                                            <p class="text-gray-400 text-xs mt-1">x1</p>
                                        </div>
                                        <span class="text-white font-medium text-sm whitespace-nowrap">
                                            Rp {{ number_format($item->game->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Price Breakdown -->
                            <div class="border-t border-gray-700 pt-4 space-y-2 mb-4">
                                <div class="flex justify-between text-gray-400 text-sm">
                                    <span>Subtotal ({{ $cartItems->count() }} item)</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-gray-400 text-sm">
                                    <span>Pajak</span>
                                    <span class="text-green-400">Rp 0</span>
                                </div>
                                <div class="flex justify-between text-gray-400 text-sm">
                                    <span>Ongkir</span>
                                    <span class="text-green-400">Gratis</span>
                                </div>
                            </div>

                            <!-- Total -->
                            <div class="border-t border-gray-700 pt-4 mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-300 font-medium">Total Pembayaran</span>
                                    <span class="text-2xl font-bold text-white">Rp
                                        {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            <form action="{{ route('payment.process') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full px-4 py-4 bg-white text-black rounded-sm hover:bg-gray-200 font-bold text-base transition uppercase tracking-wide flex items-center justify-center gap-2 mb-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                    Bayar Sekarang
                                </button>
                            </form>

                            <!-- Back to Cart -->
                            <a href="{{ route('cart.index') }}"
                                class="block text-center px-4 py-3 bg-[#2a2a2a] text-gray-300 rounded-sm hover:bg-[#3a3a3a] hover:text-white font-medium text-sm transition border border-gray-700 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Kembali ke Keranjang
                            </a>
                        </div>
                    </div>

                    <!-- Trust Badges -->
                    <div class="bg-[#1f1f1f] border border-gray-800 rounded-sm overflow-hidden p-6">
                        <h4 class="font-bold text-white mb-4 text-sm uppercase tracking-wider">Pembayaran Aman &
                            Terpercaya</h4>
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#2a2a2a] flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-xs text-gray-500">Aman</span>
                            </div>
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#2a2a2a] flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                </div>
                                <span class="text-xs text-gray-500">Terpercaya</span>
                            </div>
                            <div class="flex flex-col items-center gap-2">
                                <div class="w-10 h-10 rounded-full bg-[#2a2a2a] flex items-center justify-center">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs text-gray-500">Instan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
