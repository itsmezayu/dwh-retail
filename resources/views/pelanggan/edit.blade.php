@extends('layouts.app')

@section('title', 'Edit Pelanggan')

@section('content')
<div class="bg-white p-6 rounded shadow md:w-1/2">
    <form action="{{ route('pelanggan.update', $pelanggan->id_pelanggan) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Kode Pelanggan</label>
            <input type="text" name="kode_pelanggan" value="{{ old('kode_pelanggan', $pelanggan->kode_pelanggan) }}" class="border rounded w-full py-2 px-3 text-gray-700 bg-gray-50 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" class="border rounded w-full py-2 px-3 text-gray-700 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Jenis Kelamin</label>
            <div class="flex space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio text-blue-600" name="jenis_kelamin" value="L" {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'L' ? 'checked' : '' }} required>
                    <span class="ml-2 text-gray-700">Laki-laki (L)</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" class="form-radio text-blue-600" name="jenis_kelamin" value="P" {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'P' ? 'checked' : '' }} required>
                    <span class="ml-2 text-gray-700">Perempuan (P)</span>
                </label>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Kota</label>
            <input type="text" name="kota" value="{{ old('kota', $pelanggan->kota) }}" class="border rounded w-full py-2 px-3 text-gray-700 border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
        </div>

        <div class="mt-6 flex space-x-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Perbarui</button>
            <a href="{{ route('pelanggan.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</a>
        </div>
    </form>
</div>
@endsection
