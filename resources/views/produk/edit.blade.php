@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="bg-white p-5 rounded shadow">
    <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-5">
            <label class="block text-black font-bold mb-2">Kode Produk</label>
            <input type="text" name="kode_produk" value="{{ old('kode_produk', $produk->kode_produk) }}" class="border rounded w-full py-2 px-3 text-black bg-gray-50 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
        </div>

        <div class="mb-5">
            <label class="block text-black font-bold mb-2">Nama Produk</label>
            <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" class="border rounded w-full py-2 px-3 text-black border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
        </div>

        <div class="mb-5">
            <label class="block text-black font-bold mb-2">Kategori</label>
            <select name="kategori" class="border rounded w-full py-2 px-3 text-black border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
                <option value="Elektronik" {{ old('kategori', $produk->kategori) == 'Elektronik' ? 'selected' : '' }}>Elektronik</option>
                <option value="Pakaian" {{ old('kategori', $produk->kategori) == 'Pakaian' ? 'selected' : '' }}>Pakaian</option>
                <option value="Makanan" {{ old('kategori', $produk->kategori) == 'Makanan' ? 'selected' : '' }}>Makanan</option>
            </select>
        </div>

        <div class="mb-5">
            <label class="block text-black font-bold mb-2">Harga (Rp)</label>
            <input type="number" name="harga" value="{{ (int)old('harga', $produk->harga) }}" class="border rounded w-full py-2 px-3 text-black border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" min="0" required>
        </div>

        <div class="mt-5 flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Perbarui</button>
            <a href="{{ route('produk.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
        </div>
    </form>
</div>
@endsection
