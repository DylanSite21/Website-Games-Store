<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Shipping & Billing -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-bold text-lg mb-4">Informasi Pembeli</h3>
                        <div class="space-y-3 text-sm">
                            <div>
                                <label class="font-semibold">Nama Lengkap</label>
                                <p>{{ Auth::user()->name }}</p>
                            </div>
                            <div>
                                <label class="font-semibold">Email</label>
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <h3 class="font-bold text-lg mt-6 mb-4">Metode Pembayaran</h3>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="indomaret" checked class="mr-2">
                                <span>Indomaret / Alfamart</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="bank_transfer" class="mr-2">
                                <span>Transfer Bank</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="credit_card" class="mr-2">
                                <span>Kartu Kredit</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="payment_method" value="ewallet" class="mr-2">
                                <span>E-Wallet</span>
                            </label>
                        </div>

                        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded">
                            <p class="text-sm text-gray-600">
                                <strong>Catatan:</strong> Sistem pembayaran sedang dalam mode simulasi. Setelah klik
                                "Bayar Sekarang", pesanan akan langsung diproses sebagai PAID untuk demo purposes.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                        <div class="p-6">
                            <h3 class="font-bold text-lg mb-4">Ringkasan Pesanan</h3>
                            <div class="space-y-3 mb-4">
                                @foreach ($cartItems as $item)
                                    <div class="flex justify-between text-sm">
                                        <span>{{ $item->game->title }}</span>
                                        <span>Rp {{ number_format($item->game->price, 0, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <div class="border-t pt-4">
                                <div class="flex justify-between font-bold text-lg">
                                    <span>Total Pembayaran</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('payment.process') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-3 bg-green-600 text-white rounded hover:bg-green-700 font-bold text-lg">
                            Bayar Sekarang
                        </button>
                    </form>

                    <a href="{{ route('cart.index') }}"
                        class="block text-center mt-3 px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                        Kembali ke Keranjang
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
