@extends('layouts.app')

@section('title', 'Edit Fakta Penjualan')

@section('content')

<div class="bg-white p-5 rounded shadow mb-5 w-full">
    <form action="{{ route('penjualan.update', $penjualan->id_penjualan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <label class="block text-black font-bold mb-2">Pilih Produk</label>
                <select name="id_produk" id="id_produk" class="border rounded w-full py-2 px-3 text-black border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required onchange="updateHargaSatuan()">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->id_produk }}" data-harga="{{ $produk->harga }}" {{ old('id_produk', $penjualan->id_produk) == $produk->id_produk ? 'selected' : '' }}>
                            {{ $produk->nama_produk }} (Rp {{ number_format($produk->harga, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-black font-bold mb-2">Pilih Pelanggan</label>
                <select name="id_pelanggan" class="border rounded w-full py-2 px-3 text-black border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id_pelanggan }}" {{ old('id_pelanggan', $penjualan->id_pelanggan) == $pelanggan->id_pelanggan ? 'selected' : '' }}>
                            {{ $pelanggan->nama_pelanggan }} - {{ $pelanggan->kota }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-black font-bold mb-2">Pilih Tanggal</label>
                <select name="id_waktu" class="border rounded w-full py-2 px-3 text-black border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                    <option value="">-- Pilih Tanggal --</option>
                    @foreach($waktus as $waktu)
                        <option value="{{ $waktu->id_waktu }}" {{ old('id_waktu', $penjualan->id_waktu) == $waktu->id_waktu ? 'selected' : '' }}>
                            {{ $waktu->tanggal }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-black font-bold mb-2">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $penjualan->jumlah) }}" class="border rounded w-full py-2 px-3 text-black border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" min="1" required oninput="calculateTotal()">
            </div>

            <div>
                <label class="block text-black font-bold mb-2">Harga Satuan (Otomatis)</label>
                <input type="number" id="harga_satuan" value="0" class="border rounded w-full py-2 px-3 text-black bg-gray-100 border-gray-300" readonly>
            </div>

            <div>
                <label class="block text-black font-bold mb-2">Total Harga (Otomatis)</label>
                <input type="number" id="total_harga" value="0" class="border rounded w-full py-2 px-3 text-black bg-gray-100 border-gray-300 font-bold text-green-700" readonly>
            </div>

        </div>

        <div class="mt-5 flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Perbarui Transaksi</button>
            <a href="{{ route('penjualan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    function updateHargaSatuan() {
        const selectProduk = document.getElementById('id_produk');
        const selectedOption = selectProduk.options[selectProduk.selectedIndex];

        let harga = 0;
        if(selectedOption && selectedOption.value !== "") {
            harga = selectedOption.getAttribute('data-harga');
        }

        document.getElementById('harga_satuan').value = harga;
        calculateTotal();
    }

    function calculateTotal() {
        const harga = document.getElementById('harga_satuan').value || 0;
        const jumlah = document.getElementById('jumlah').value || 1;
        const total = parseFloat(harga) * parseInt(jumlah);

        document.getElementById('total_harga').value = total;
    }

    // Call on load
    window.onload = function() {
        updateHargaSatuan();
    }
</script>
@endpush
