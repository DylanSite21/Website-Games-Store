<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Penjualan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics -->
            <div class="grid md:grid-cols-3 gap-6 mb-6">
                <!-- Total Revenue -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-gray-600 text-sm">Total Pendapatan</p>
                        <p class="text-4xl font-bold text-green-600">
                            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <!-- Total Sales -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-gray-600 text-sm">Total Penjualan</p>
                        <p class="text-4xl font-bold text-blue-600">{{ $totalSales }}</p>
                    </div>
                </div>

                <!-- Average Price -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <p class="text-gray-600 text-sm">Rata-rata Harga/Produk</p>
                        <p class="text-4xl font-bold text-purple-600">
                            @if ($totalSales > 0)
                                Rp {{ number_format($totalRevenue / $totalSales, 0, ',', '.') }}
                            @else
                                Rp 0
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Revenue by Game -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-4">Pendapatan per Game</h3>
                    @if ($gameRevenue->count())
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border px-4 py-2 text-left">Game</th>
                                        <th class="border px-4 py-2 text-right">Terjual</th>
                                        <th class="border px-4 py-2 text-right">Pendapatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gameRevenue as $data)
                                        <tr>
                                            <td class="border px-4 py-2">
                                                <a href="{{ route('game.show', $data['game']) }}"
                                                    class="text-blue-600 hover:underline">
                                                    {{ $data['game']->title }}
                                                </a>
                                            </td>
                                            <td class="border px-4 py-2 text-right">{{ $data['count'] }} penjualan</td>
                                            <td class="border px-4 py-2 text-right font-bold">
                                                Rp {{ number_format($data['revenue'], 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-600">Belum ada penjualan.</p>
                    @endif
                </div>
            </div>

            <!-- Recent Sales -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-4">Penjualan Terakhir</h3>
                    @if ($sales->count())
                        <div class="overflow-x-auto">
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="border px-4 py-2 text-left">Game</th>
                                        <th class="border px-4 py-2 text-left">Pembeli</th>
                                        <th class="border px-4 py-2 text-right">Harga</th>
                                        <th class="border px-4 py-2 text-left">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $sale->game->title }}</td>
                                            <td class="border px-4 py-2">{{ $sale->transaction->user->name }}</td>
                                            <td class="border px-4 py-2 text-right font-bold">
                                                Rp {{ number_format($sale->price_at_purchase, 0, ',', '.') }}
                                            </td>
                                            <td class="border px-4 py-2">
                                                {{ $sale->created_at->format('d M Y H:i') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $sales->links() }}
                        </div>
                    @else
                        <p class="text-gray-600">Belum ada penjualan terakhir.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
