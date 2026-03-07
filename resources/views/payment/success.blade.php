<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                {{ __('Pembayaran Berhasil') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen bg-[#121212]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Success Card -->
            <div class="bg-[#1f1f1f] border border-gray-800 rounded-sm overflow-hidden shadow-xl">
                <div class="p-8 text-center">

                    <!-- Success Icon with Animation -->
                    <div class="mb-6">
                        <div
                            class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-green-600/20 border-4 border-green-600/30 mb-4 animate-pulse">
                            <svg class="w-12 h-12 text-green-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Success Message -->
                    <h1 class="text-3xl font-extrabold text-white mb-3">Pembayaran Berhasil!</h1>
                    <p class="text-gray-400 mb-8 max-w-md mx-auto">
                        Pesanan Anda telah dikonfirmasi dan sedang diproses. Game telah ditambahkan ke perpustakaan
                        Anda.
                    </p>

                    <!-- Transaction Details Card -->
                    <div class="bg-[#121212] border border-gray-800 rounded-sm p-6 mb-6 text-left">
                        <h2 class="font-bold text-lg text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Detail Transaksi
                        </h2>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between items-center py-2 border-b border-gray-800">
                                <span class="text-gray-400">Nomor Transaksi</span>
                                <span
                                    class="font-mono text-white font-semibold">{{ $transaction->transaction_code }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-800">
                                <span class="text-gray-400">Tanggal</span>
                                <span class="text-white">{{ $transaction->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-gray-800">
                                <span class="text-gray-400">Status</span>
                                <span
                                    class="px-3 py-1 bg-green-600/20 text-green-400 rounded-sm text-xs font-bold border border-green-600/30 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-3">
                                <span class="text-gray-400 font-medium">Total Pembayaran</span>
                                <span class="text-2xl font-bold text-white">Rp
                                    {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Purchased Items Card -->
                    <div class="bg-[#121212] border border-gray-800 rounded-sm p-6 mb-6 text-left">
                        <h2 class="font-bold text-lg text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Game yang Dibeli
                        </h2>

                        <div class="space-y-3">
                            @foreach ($items as $item)
                                <div
                                    class="flex justify-between items-center p-3 bg-[#1f1f1f] rounded-sm border border-gray-800 hover:border-gray-700 transition">
                                    <div class="flex items-center gap-3">
                                        @if ($item->game->cover_url)
                                            <img src="{{ $item->game->cover_url }}" alt="{{ $item->game->title }}"
                                                class="w-12 h-8 object-cover rounded-sm">
                                        @endif
                                        <div>
                                            <p class="font-semibold text-white text-sm">{{ $item->game->title }}</p>
                                            <p class="text-xs text-gray-500 font-mono">ID: {{ $item->game->id }}</p>
                                        </div>
                                    </div>
                                    <span class="font-bold text-white text-sm">Rp
                                        {{ number_format($item->price_at_purchase, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Email Confirmation -->
                    <div class="p-4 bg-blue-900/30 border border-blue-700/50 rounded-sm mb-6">
                        <div class="flex items-center gap-3 text-sm text-gray-300">
                            <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span>Email konfirmasi telah dikirim ke <strong
                                    class="text-white">{{ Auth::user()->email }}</strong></span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3 max-w-md mx-auto">
                        <a href="{{ route('library.index') }}"
                            class="block w-full px-6 py-4 bg-white text-black rounded-sm hover:bg-gray-200 font-bold text-base transition uppercase tracking-wide flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                </path>
                            </svg>
                            Lihat Game yang Dibeli
                        </a>

                        <a href="{{ route('home') }}"
                            class="block w-full px-6 py-4 bg-[#2a2a2a] text-white rounded-sm hover:bg-[#3a3a3a] font-medium text-base transition border border-gray-700 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Lanjut Belanja
                        </a>
                    </div>

                    <!-- Order Reference -->
                    <div class="mt-8 pt-6 border-t border-gray-800">
                        <p class="text-xs text-gray-500">
                            Simpan nomor transaksi Anda untuk referensi:
                            <span
                                class="font-mono text-gray-400 select-all">{{ $transaction->transaction_code }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Support Card -->
            <div class="mt-6 bg-[#1f1f1f] border border-gray-800 rounded-sm overflow-hidden p-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-[#2a2a2a] flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-white mb-2">Butuh Bantuan?</h4>
                        <p class="text-sm text-gray-400 mb-3">
                            Jika Anda mengalami masalah dengan pesanan ini, tim support kami siap membantu Anda.
                        </p>
                        <a href="#"
                            class="text-sm text-blue-400 hover:text-blue-300 hover:underline flex items-center gap-1">
                            Hubungi Support
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
