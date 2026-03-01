<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembayaran Berhasil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center">
                    <div class="mb-4">
                        <svg class="w-16 h-16 text-green-600 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>

                    <h1 class="text-3xl font-bold text-green-600 mb-2">Pembayaran Berhasil!</h1>
                    <p class="text-gray-600 mb-6">Pesanan Anda telah dikonfirmasi dan sedang diproses.</p>

                    <!-- Invoice Details -->
                    <div class="bg-gray-50 border border-gray-200 rounded p-6 mb-6 text-left">
                        <h2 class="font-bold text-lg mb-4">Detail Transaksi</h2>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nomor Transaksi</span>
                                <span class="font-semibold">{{ $transaction->transaction_code }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tanggal</span>
                                <span>{{ $transaction->created_at->format('d M Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Status</span>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </div>
                            <div class="flex justify-between font-bold text-lg border-t pt-2 mt-2">
                                <span>Total Pembayaran</span>
                                <span>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Purchased Items -->
                    <div class="bg-gray-50 border border-gray-200 rounded p-6 mb-6 text-left">
                        <h2 class="font-bold text-lg mb-4">Game yang Dibeli</h2>
                        <div class="space-y-3">
                            @foreach ($items as $item)
                                <div class="flex justify-between items-center">
                                    <div>
                                        <p class="font-semibold">{{ $item->game->title }}</p>
                                        <p class="text-sm text-gray-600">ID: {{ $item->game->id }}</p>
                                    </div>
                                    <span class="font-bold">Rp
                                        {{ number_format($item->price_at_purchase, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="space-y-3">
                        <a href="{{ route('library.index') }}"
                            class="block w-full px-4 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 font-bold">
                            Lihat Game yang Dibeli
                        </a>
                        <a href="{{ route('home') }}"
                            class="block w-full px-4 py-3 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 font-bold">
                            Lanjut Belanja
                        </a>
                    </div>

                    <p class="mt-6 text-sm text-gray-600">
                        Email konfirmasi telah dikirim ke <strong>{{ Auth::user()->email }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
