<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Pembayaran') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if ($transactions->count())
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border px-4 py-2 text-left">No. Transaksi</th>
                                        <th class="border px-4 py-2 text-left">Tanggal</th>
                                        <th class="border px-4 py-2 text-left">Total</th>
                                        <th class="border px-4 py-2 text-left">Status</th>
                                        <th class="border px-4 py-2">Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                        <tr>
                                            <td class="border px-4 py-2">
                                                <span
                                                    class="font-mono text-sm">{{ $transaction->transaction_code }}</span>
                                            </td>
                                            <td class="border px-4 py-2">
                                                {{ $transaction->created_at->format('d M Y H:i') }}</td>
                                            <td class="border px-4 py-2 font-bold">
                                                Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                            </td>
                                            <td class="border px-4 py-2">
                                                @if ($transaction->status === 'paid')
                                                    <span
                                                        class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">
                                                        Dibayar
                                                    </span>
                                                @elseif ($transaction->status === 'pending')
                                                    <span
                                                        class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-semibold">
                                                        Menunggu
                                                    </span>
                                                @else
                                                    <span
                                                        class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-semibold">
                                                        {{ ucfirst($transaction->status) }}
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="border px-4 py-2 text-center">
                                                <button onclick="toggleDetails('{{ $transaction->id }}')"
                                                    class="text-blue-600 hover:underline text-sm">
                                                    Lihat
                                                </button>
                                            </td>
                                        </tr>
                                        <tr id="details-{{ $transaction->id }}" class="hidden">
                                            <td colspan="5" class="bg-gray-50 px-4 py-4">
                                                <div class="max-w-2xl">
                                                    <h4 class="font-bold mb-3">Game dalam Transaksi:</h4>
                                                    <ul class="space-y-2">
                                                        @foreach ($transaction->items as $item)
                                                            <li class="flex justify-between text-sm">
                                                                <span>{{ $item->game->title }}</span>
                                                                <span class="text-gray-600">
                                                                    Rp
                                                                    {{ number_format($item->price_at_purchase, 0, ',', '.') }}
                                                                </span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $transactions->links() }}
                        </div>
                    @else
                        <p class="text-gray-600">Belum ada riwayat pembayaran.</p>
                        <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Belanja sekarang</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDetails(id) {
            const element = document.getElementById('details-' + id);
            element.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
