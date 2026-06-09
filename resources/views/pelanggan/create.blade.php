@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')
<div class="bg-white p-5 rounded shadow">
    <form action="{{ route('pelanggan.store') }}" method="POST">
        @csrf

        <div class="mb-5">
            <label class="block text-black font-bold mb-2">Kode Pelanggan</label>
            <input type="text" name="kode_pelanggan" value="{{ old('kode_pelanggan') }}" class="border rounded w-full py-2 px-3 text-black bg-gray-50 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
        </div>

        <div class="mb-5">
            <label class="block text-black font-bold mb-2">Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" class="border rounded w-full py-2 px-3 text-black border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
        </div>

        <div class="mb-5">
            <label class="block text-black font-bold mb-2">Jenis Kelamin</label>
            <div class="flex space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio text-blue-600" name="jenis_kelamin" value="L" {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} required>
                    <span class="ml-2 text-black">Laki-laki (L)</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio text-blue-600" name="jenis_kelamin" value="P" {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} required>
                    <span class="ml-2 text-black">Perempuan (P)</span>
                </label>
            </div>
        </div>

        <div class="mb-5">
            <label class="block text-black font-bold mb-2">Kota</label>
            <input type="text" name="kota" value="{{ old('kota') }}" class="border rounded w-full py-2 px-3 text-black border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
        </div>

        <div class="mt-5 flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('pelanggan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
        </div>
    </form>
</div>
@endsection
