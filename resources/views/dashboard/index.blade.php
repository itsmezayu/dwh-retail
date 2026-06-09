@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="mb-6">
    <form action="{{ route('dashboard.index') }}" method="GET" class="flex items-center space-x-2 w-full md:w-1/3">
        <label for="kategori" class="font-semibold text-gray-700">Filter Kategori:</label>
        <select name="kategori" id="kategori" class="border gray-300 rounded p-2 text-gray-700 w-full" onchange="this.form.submit()">
            <option value="Semua" {{ $kategori == 'Semua' ? 'selected' : '' }}>Semua</option>
            <option value="Elektronik" {{ $kategori == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
            <option value="Pakaian" {{ $kategori == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
            <option value="Makanan" {{ $kategori == 'Makanan' ? 'selected' : '' }}>Makanan</option>
        </select>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <!-- Bar Chart -->
    <div class="bg-white p-4 shadow rounded">
        <h3 class="font-bold text-gray-700 mb-4 text-center">Total Penjualan per Produk</h3>
        <canvas id="barChart"></canvas>
    </div>

    <!-- Line Chart -->
    <div class="bg-white p-4 shadow rounded">
        <h3 class="font-bold text-gray-700 mb-4 text-center">Tren Penjualan per Bulan</h3>
        <canvas id="lineChart"></canvas>
    </div>
</div>

<!-- Table Pelanggan -->
<div class="bg-white p-4 shadow rounded w-full">
    <h3 class="font-bold text-gray-700 mb-4 text-center">Pelanggan dengan Belanja Tertinggi</h3>
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-800 text-white rounded">
                <th class="p-3 border-b">No</th>
                <th class="p-3 border-b">Nama Pelanggan</th>
                <th class="p-3 border-b">Jumlah Transaksi</th>
                <th class="p-3 border-b">Total Belanja</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pelangganTertinggi as $index => $pl)
                <tr class="hover:bg-gray-100 border-b">
                    <td class="p-3">{{ $index + 1 }}</td>
                    <td class="p-3 font-semibold">{{ $pl->nama_pelanggan }}</td>
                    <td class="p-3">{{ $pl->jumlah_transaksi }}</td>
                    <td class="p-3 text-green-600 font-semibold">{{ rupiah($pl->total_belanja) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-3 text-center text-gray-500">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
<script>
    // Data untuk Bar Chart
    const barLabels = {!! json_encode(array_column($totalPenjualanPerProduk, 'nama_produk')) !!};
    const barData = {!! json_encode(array_column($totalPenjualanPerProduk, 'total_pendapatan')) !!};

    const ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: barLabels,
            datasets: [{
                label: 'Total Pendapatan (Rp)',
                data: barData,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Data untuk Line Chart
    const lineLabels = {!! json_encode(array_map(function($item) {
        return $item->bulan_nama . ' ' . $item->tahun;
    }, $trenPenjualanPerBulan)) !!};
    const lineData = {!! json_encode(array_column($trenPenjualanPerBulan, 'total_pendapatan')) !!};

    const ctxLine = document.getElementById('lineChart').getContext('2d');
    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: lineLabels,
            datasets: [{
                label: 'Total Pendapatan (Rp)',
                data: lineData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
