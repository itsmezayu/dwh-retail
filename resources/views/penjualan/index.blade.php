@extends('layouts.app')

@section('title', 'Data Fakta Penjualan')

@section('content')

<!-- Bagian Atas: Form Tambah Transaksi -->
<div class="bg-white p-6 rounded shadow mb-6 w-full">
    <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">Tambah Transaksi</h3>
    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Kolom 1 -->
            <div>
                <label class="block text-gray-700 font-bold mb-2">Pilih Produk</label>
                <select name="id_produk" id="id_produk" class="border rounded w-full py-2 px-3 text-gray-700 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required onchange="updateHargaSatuan()">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produks as $produk)
                        <option value="{{ $produk->id_produk }}" data-harga="{{ $produk->harga }}" {{ old('id_produk') == $produk->id_produk ? 'selected' : '' }}>
                            {{ $produk->nama_produk }} (Rp {{ number_format($produk->harga, 0, ',', '.') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Pilih Pelanggan</label>
                <select name="id_pelanggan" class="border rounded w-full py-2 px-3 text-gray-700 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($pelanggans as $pelanggan)
                        <option value="{{ $pelanggan->id_pelanggan }}" {{ old('id_pelanggan') == $pelanggan->id_pelanggan ? 'selected' : '' }}>
                            {{ $pelanggan->nama_pelanggan }} - {{ $pelanggan->kota }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Pilih Tanggal</label>
                <select name="id_waktu" class="border rounded w-full py-2 px-3 text-gray-700 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                    <option value="">-- Pilih Tanggal --</option>
                    @foreach($waktus as $waktu)
                        <option value="{{ $waktu->id_waktu }}" {{ old('id_waktu') == $waktu->id_waktu ? 'selected' : '' }}>
                            {{ $waktu->tanggal }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Kolom 2 -->
            <div>
                <label class="block text-gray-700 font-bold mb-2">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', 1) }}" class="border rounded w-full py-2 px-3 text-gray-700 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" min="1" required oninput="calculateTotal()">
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Harga Satuan (Otomatis)</label>
                <input type="number" id="harga_satuan" value="0" class="border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 border-gray-300" readonly>
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">Total Harga (Otomatis)</label>
                <input type="number" id="total_harga" value="0" class="border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 border-gray-300 font-bold text-green-700" readonly>
            </div>

        </div>

        <div class="mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold hover:bg-blue-700">Simpan Transaksi</button>
        </div>
    </form>
</div>

<!-- Bagian Bawah: Tabel Transaksi -->
<div class="bg-white px-4 py-4 shadow rounded w-full overflow-x-auto">
    <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">Data Transaksi</h3>
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-800 text-white rounded">
                <th class="p-3 border-b">ID</th>
                <th class="p-3 border-b">Produk</th>
                <th class="p-3 border-b">Pelanggan</th>
                <th class="p-3 border-b">Tanggal</th>
                <th class="p-3 border-b">Jml</th>
                <th class="p-3 border-b">Total</th>
                <th class="p-3 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penjualans as $penjualan)
                <tr class="hover:bg-gray-100 border-b">
                    <td class="p-3">{{ $penjualan->id_penjualan }}</td>
                    <td class="p-3">{{ $penjualan->produk->nama_produk }}</td>
                    <td class="p-3">{{ $penjualan->pelanggan->nama_pelanggan }}</td>
                    <td class="p-3">{{ $penjualan->waktu->tanggal }}</td>
                    <td class="p-3 font-semibold">{{ $penjualan->jumlah }}</td>
                    <td class="p-3 text-green-600">{{ rupiah($penjualan->total_harga) }}</td>
                    <td class="p-3 flex space-x-2">
                        <a href="{{ route('penjualan.edit', $penjualan->id_penjualan) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('penjualan.destroy', $penjualan->id_penjualan) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="p-3 text-center text-gray-500">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
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
