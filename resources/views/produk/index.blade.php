@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')
<div class="mb-4">
    <a href="{{ route('produk.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">＋ Tambah Produk</a>
</div>

<div class="bg-white px-4 py-4 shadow rounded w-full overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-800 text-white rounded">
                <th class="p-3 border-b">Kode</th>
                <th class="p-3 border-b">Nama Produk</th>
                <th class="p-3 border-b">Kategori</th>
                <th class="p-3 border-b">Harga</th>
                <th class="p-3 border-b">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produks as $produk)
                <tr class="hover:bg-gray-100 border-b">
                    <td class="p-3">{{ $produk->kode_produk }}</td>
                    <td class="p-3">{{ $produk->nama_produk }}</td>
                    <td class="p-3 text-sm"><span class="bg-gray-200 px-2 py-1 rounded">{{ $produk->kategori }}</span></td>
                    <td class="p-3">{{ rupiah($produk->harga) }}</td>
                    <td class="p-3 flex space-x-2">
                        <a href="{{ route('produk.edit', $produk->id_produk) }}" class="bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">Edit</a>
                        <form action="{{ route('produk.destroy', $produk->id_produk) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
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
