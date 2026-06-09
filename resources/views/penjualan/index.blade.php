@extends('layouts.app')

@section('title', 'Data Fakta Penjualan')

@section('content')
<div class="mt-2 mb-5">
    <a href="{{ route('penjualan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">＋ Tambah Transaksi</a>
</div>

<div class="bg-white px-4 py-4 shadow rounded w-full overflow-x-auto">
    <h3 class="font-bold text-black mb-5 text-center">Data Transaksi</h3>
    <table class="w-full text-left border-collapse datatable">
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
