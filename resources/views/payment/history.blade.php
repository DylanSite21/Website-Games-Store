<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </a>
                <h2 class="font-bold text-2xl text-white leading-tight tracking-tight">
                    {{ __('Riwayat Pembayaran') }}
                </h2>
            </div>
            <span class="px-3 py-1 bg-[#2a2a2a] text-gray-300 text-xs font-medium rounded-sm border border-gray-700">
                {{ $transactions->count() }} Transaksi
            </span>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen bg-[#121212]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if ($transactions->count())
                <!-- Transactions Table Card -->
                <div class="bg-[#1f1f1f] border border-gray-800 rounded-sm overflow-hidden shadow-xl">
                    <div class="p-6">
                        <!-- Table Header -->
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-bold text-lg text-white flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                                Daftar Transaksi
                            </h3>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="border-b border-gray-800">
                                        <th
                                            class="text-left py-4 px-4 text-xs text-gray-500 uppercase tracking-wider font-medium">
                                            No. Transaksi</th>
                                        <th
                                            class="text-left py-4 px-4 text-xs text-gray-500 uppercase tracking-wider font-medium">
                                            Tanggal</th>
                                        <th
                                            class="text-left py-4 px-4 text-xs text-gray-500 uppercase tracking-wider font-medium">
                                            Total</th>
                                        <th
                                            class="text-left py-4 px-4 text-xs text-gray-500 uppercase tracking-wider font-medium">
                                            Status</th>
                                        <th
                                            class="text-center py-4 px-4 text-xs text-gray-500 uppercase tracking-wider font-medium">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-800">
                                    @foreach ($transactions as $transaction)
                                        <tr class="hover:bg-[#2a2a2a] transition">
                                            <td class="py-4 px-4">
                                                <span
                                                    class="font-mono text-sm text-gray-300">{{ $transaction->transaction_code }}</span>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="text-white text-sm">
                                                    {{ $transaction->created_at->format('d M Y') }}</div>
                                                <div class="text-gray-500 text-xs">
                                                    {{ $transaction->created_at->format('H:i') }}</div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <span class="font-bold text-white">Rp
                                                    {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                                            </td>
                                            <td class="py-4 px-4">
                                                @if ($transaction->status === 'paid')
                                                    <span
                                                        class="inline-flex items-center gap-1 px-3 py-1 bg-green-600/20 text-green-400 rounded-sm text-xs font-bold border border-green-600/30">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        Dibayar
                                                    </span>
                                                @elseif ($transaction->status === 'pending')
                                                    <span
                                                        class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-600/20 text-yellow-400 rounded-sm text-xs font-bold border border-yellow-600/30">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Menunggu
                                                    </span>
                                                @elseif ($transaction->status === 'failed')
                                                    <span
                                                        class="inline-flex items-center gap-1 px-3 py-1 bg-red-600/20 text-red-400 rounded-sm text-xs font-bold border border-red-600/30">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                        Gagal
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center gap-1 px-3 py-1 bg-gray-600/20 text-gray-400 rounded-sm text-xs font-bold border border-gray-600/30">
                                                        {{ ucfirst($transaction->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-4 px-4 text-center">
                                                <button onclick="toggleDetails('{{ $transaction->id }}')"
                                                    class="inline-flex items-center gap-1 px-4 py-2 bg-[#2a2a2a] text-gray-300 rounded-sm hover:bg-white hover:text-black text-xs font-medium transition border border-gray-700 hover:border-white">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    Lihat Detail
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Transaction Details (Hidden by default) -->
                                        <tr id="details-{{ $transaction->id }}" class="hidden">
                                            <td colspan="5" class="bg-[#121212] px-4 py-6">
                                                <div class="max-w-3xl">
                                                    <h4 class="font-bold text-white mb-4 flex items-center gap-2">
                                                        <svg class="w-5 h-5 text-gray-400" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                                        </svg>
                                                        Game dalam Transaksi
                                                    </h4>

                                                    <div class="space-y-3">
                                                        @foreach ($transaction->items as $item)
                                                            <div
                                                                class="flex items-center justify-between p-4 bg-[#1f1f1f] rounded-sm border border-gray-800 hover:border-gray-700 transition">
                                                                <div class="flex items-center gap-4">
                                                                    @if ($item->game->cover_url)
                                                                        <img src="{{ $item->game->cover_url }}"
                                                                            alt="{{ $item->game->title }}"
                                                                            class="w-20 h-12 object-cover rounded-sm">
                                                                    @endif
                                                                    <div>
                                                                        <p class="font-semibold text-white text-sm">
                                                                            {{ $item->game->title }}</p>
                                                                        <p class="text-xs text-gray-500 font-mono">ID:
                                                                            {{ $item->game->id }}</p>
                                                                    </div>
                                                                </div>
                                                                <span class="font-bold text-white text-sm">Rp
                                                                    {{ number_format($item->price_at_purchase, 0, ',', '.') }}</span>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    <!-- Transaction Summary -->
                                                    <div
                                                        class="mt-6 p-4 bg-[#1f1f1f] rounded-sm border border-gray-800">
                                                        <div class="grid grid-cols-2 gap-4 text-sm">
                                                            <div>
                                                                <span class="text-gray-500 block mb-1">Metode
                                                                    Pembayaran</span>
                                                                <span
                                                                    class="text-white font-medium">{{ ucfirst($transaction->payment_method ?? 'N/A') }}</span>
                                                            </div>
                                                            <div>
                                                                <span class="text-gray-500 block mb-1">Email</span>
                                                                <span
                                                                    class="text-white font-medium">{{ $transaction->user->email ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($transactions->hasPages())
                            <div class="mt-6 pt-6 border-t border-gray-800">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-400">
                                        Menampilkan <span
                                            class="text-white font-medium">{{ $transactions->firstItem() }}</span>
                                        sampai <span
                                            class="text-white font-medium">{{ $transactions->lastItem() }}</span>
                                        dari <span class="text-white font-medium">{{ $transactions->total() }}</span>
                                        transaksi
                                    </p>
                                    <div class="pagination">
                                        {{ $transactions->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-[#1f1f1f] border border-gray-800 rounded-sm overflow-hidden">
                    <div class="p-12 text-center">
                        <!-- Empty Icon -->
                        <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-[#2a2a2a] mb-6">
                            <svg class="w-12 h-12 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>

                        <h3 class="text-xl font-bold text-white mb-2">Belum Ada Riwayat Pembayaran</h3>
                        <p class="text-gray-400 mb-6 max-w-md mx-auto">
                            Anda belum memiliki transaksi apapun. Jelajahi katalog kami dan mulai belanja game favorit
                            Anda!
                        </p>

                        <a href="{{ route('home') }}"
                            class="inline-flex items-center px-6 py-3 bg-white text-black font-bold rounded-sm hover:bg-gray-200 transition uppercase tracking-wide">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Belanja Sekarang
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Toggle Script -->
    <script>
        function toggleDetails(id) {
            const element = document.getElementById('details-' + id);
            const button = event.currentTarget;

            if (element.classList.contains('hidden')) {
                element.classList.remove('hidden');
                button.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                    </svg>
                    Tutup Detail
                `;
                button.classList.remove('bg-[#2a2a2a]', 'text-gray-300');
                button.classList.add('bg-white', 'text-black');
            } else {
                element.classList.add('hidden');
                button.innerHTML = `
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Lihat Detail
                `;
                button.classList.remove('bg-white', 'text-black');
                button.classList.add('bg-[#2a2a2a]', 'text-gray-300');
            }
        }
    </script>

    <!-- Pagination Dark Style -->
    <style>
        .pagination svg {
            color: #9ca3af;
        }

        .pagination svg:hover {
            color: #ffffff;
        }

        .pagination .text-gray-500 {
            color: #6b7280 !important;
        }

        .pagination .text-gray-700 {
            color: #ffffff !important;
            background-color: #2a2a2a !important;
            border-color: #374151 !important;
        }

        .pagination .text-gray-700:hover {
            background-color: #3a3a3a !important;
        }

        .pagination .border-gray-300 {
            border-color: #374151 !important;
        }
    </style>
</x-app-layout>
