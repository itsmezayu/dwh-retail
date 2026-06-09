@extends('layouts.app')

@section('title', 'Data Pelanggan')

@section('content')
<div class="mb-4">
    <a href="{{ route('pelanggan.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">＋ Tambah Pelanggan</a>
</div>

<div class="bg-white px-4 py-4 shadow rounded w-full overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-800 text-white rounded">
                <th class="p-3 border-b">Kode</th>
                <th class="p-3 border-b">Nama Pelanggan</th>
                <th class="p-3 border-b">L / P</th>
                <th class="p-3 border-b">Kota</th>
                <th class="p-3 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pelanggans as $pelanggan)
                <tr class="hover:bg-gray-100 border-b">
                    <td class="p-3">{{ $pelanggan->kode_pelanggan }}</td>
                    <td class="p-3">{{ $pelanggan->nama_pelanggan }}</td>
                    <td class="p-3">{{ $pelanggan->jenis_kelamin }}</td>
                    <td class="p-3">{{ $pelanggan->kota }}</td>
                    <td class="p-3 flex space-x-2">
                        <a href="{{ route('pelanggan.edit', $pelanggan->id_pelanggan) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('pelanggan.destroy', $pelanggan->id_pelanggan) }}" method="POST" onsubmit="return confirm('Hapus pelanggan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm hover:bg-red-600">Hapus</button>
                        </form>
                    </td>
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
