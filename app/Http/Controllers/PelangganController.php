<?php

namespace App\Http\Controllers;

use App\Models\DimPelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = DimPelanggan::all();
        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pelanggan' => 'required|unique:dim_pelanggan,kode_pelanggan',
            'nama_pelanggan' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'kota' => 'required|string|max:50',
        ]);

        DimPelanggan::create($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit(DimPelanggan $pelanggan)
    {
        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, DimPelanggan $pelanggan)
    {
        $request->validate([
            'kode_pelanggan' => 'required|unique:dim_pelanggan,kode_pelanggan,' . $pelanggan->id_pelanggan . ',id_pelanggan',
            'nama_pelanggan' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'kota' => 'required|string|max:50',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy(DimPelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
