@extends('layouts.app')

@section('title', 'Tambah Tanggal')

@section('content')
<div class="bg-white p-5 rounded shadow mb-5 w-full">
    <form action="{{ route('waktu.store') }}" method="POST">
        @csrf

        <div class="mb-5">
            <label class="block text-black font-bold mb-2">Pilih Tanggal</label>
            <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" class="border rounded w-full py-2 px-3 text-black border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required onchange="calculateTimeDimensions(this.value)">
        </div>

        <div class="grid grid-cols-2 gap-5 mb-5">
            <div>
                <label class="block text-black font-bold mb-2 text-sm">Tahun</label>
                <input type="number" id="tahun" name="tahun" value="{{ old('tahun') }}" class="border rounded w-full py-2 px-3 text-black bg-gray-100 border-gray-300" readonly required>
            </div>
            <div>
                <label class="block text-black font-bold mb-2 text-sm">Bulan (Angka)</label>
                <input type="number" id="bulan" name="bulan" value="{{ old('bulan') }}" class="border rounded w-full py-2 px-3 text-black bg-gray-100 border-gray-300" readonly required>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-5 mb-5">
            <div>
                <label class="block text-black font-bold mb-2 text-sm">Nama Bulan</label>
                <input type="text" id="bulan_nama" name="bulan_nama" value="{{ old('bulan_nama') }}" class="border rounded w-full py-2 px-3 text-black bg-gray-100 border-gray-300" readonly required>
            </div>
            <div>
                <label class="block text-black font-bold mb-2 text-sm">Kuartal</label>
                <input type="number" id="kuartal" name="kuartal" value="{{ old('kuartal') }}" class="border rounded w-full py-2 px-3 text-black bg-gray-100 border-gray-300" readonly required>
            </div>
        </div>

        <div class="mt-5 flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Waktu</button>
            <a href="{{ route('waktu.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
        </div>
    </form>
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
