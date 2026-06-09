@extends('layouts.app')

@section('title', 'Data Waktu')

@section('content')

<!-- Bagian Tambah Waktu -->
<div class="bg-white p-6 rounded shadow mb-6 w-full md:w-1/2">
    <h3 class="font-bold text-gray-700 mb-4 border-b pb-2">Tambah Tanggal</h3>
    <form action="{{ route('waktu.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Pilih Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" class="border rounded w-full py-2 px-3 text-gray-700 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required onchange="calculateTimeDimensions(this.value)">
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm">Tahun</label>
                <input type="number" id="tahun" name="tahun" value="{{ old('tahun') }}" class="border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 border-gray-300" readonly required>
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm">Bulan (Angka)</label>
                <input type="number" id="bulan" name="bulan" value="{{ old('bulan') }}" class="border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 border-gray-300" readonly required>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm">Nama Bulan</label>
                <input type="text" id="bulan_nama" name="bulan_nama" value="{{ old('bulan_nama') }}" class="border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 border-gray-300" readonly required>
            </div>
            <div>
                <label class="block text-gray-700 font-bold mb-2 text-sm">Kuartal</label>
                <input type="number" id="kuartal" name="kuartal" value="{{ old('kuartal') }}" class="border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 border-gray-300" readonly required>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Waktu</button>
        </div>
    </form>
</div>

<!-- Tabel Daftar Waktu -->
<div class="bg-white px-4 py-4 shadow rounded w-full overflow-x-auto">
    <table class="w-full text-left border-collapse datatable">
        <thead>
            <tr class="bg-gray-800 text-white rounded">
                <th class="p-3 border-b">ID</th>
                <th class="p-3 border-b">Tanggal</th>
                <th class="p-3 border-b">Tahun</th>
                <th class="p-3 border-b">Bulan</th>
                <th class="p-3 border-b">Kuartal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($waktus as $waktu)
                <tr class="hover:bg-gray-100 border-b">
                    <td class="p-3">{{ $waktu->id_waktu }}</td>
                    <td class="p-3">{{ $waktu->tanggal }}</td>
                    <td class="p-3">{{ $waktu->tahun }}</td>
                    <td class="p-3">{{ $waktu->bulan_nama }} ({{ $waktu->bulan }})</td>
                    <td class="p-3">Q{{ $waktu->kuartal }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-3 text-center text-gray-500">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

@push('scripts')
<script>
    function calculateTimeDimensions(dateString) {
        if (!dateString) return;

        const date = new Date(dateString);
        const tahun = date.getFullYear();
        const bulan = date.getMonth() + 1; // getMonth is 0-indexed
        const kuartal = Math.ceil(bulan / 3);

        const namaBulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        document.getElementById('tahun').value = tahun;
        document.getElementById('bulan').value = bulan;
        document.getElementById('bulan_nama').value = namaBulan[bulan - 1];
        document.getElementById('kuartal').value = kuartal;
    }

    // Call onload in case of validation error preservation
    window.onload = function() {
        const tglInput = document.getElementById('tanggal').value;
        if(tglInput) calculateTimeDimensions(tglInput);
    }
</script>
@endpush
