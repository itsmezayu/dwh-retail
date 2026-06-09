@extends('layouts.app')

@section('title', 'Data Waktu')

@section('content')
<div class="mt-2 mb-5">
    <a href="{{ route('waktu.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">＋ Tambah Tanggal</a>
</div>

<div class="bg-white px-4 py-4 shadow rounded w-full overflow-x-auto">
    <table class="w-full text-left border-collapse datatable">
        <thead>
            <tr class="bg-slate-800 text-white rounded">
                <th class="p-3 border-b">ID</th>
                <th class="p-3 border-b">Tanggal</th>
                <th class="p-3 border-b">Tahun</th>
                <th class="p-3 border-b">Bulan</th>
                <th class="p-3 border-b">Kuartal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($waktus as $waktu)
                <tr class="hover:bg-slate-100 border-b">
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
