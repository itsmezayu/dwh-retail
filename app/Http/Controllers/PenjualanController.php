<?php

namespace App\Http\Controllers;

use App\Models\FactPenjualan;
use App\Models\DimProduk;
use App\Models\DimPelanggan;
use App\Models\DimWaktu;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = FactPenjualan::with(['produk', 'pelanggan', 'waktu'])->orderBy('id_penjualan', 'desc')->get();
        $produks = DimProduk::all();
        $pelanggans = DimPelanggan::all();
        $waktus = DimWaktu::orderBy('tanggal', 'desc')->get();

        return view('penjualan.index', compact('penjualans', 'produks', 'pelanggans', 'waktus'));
    }

    public function create()
    {
        $produks = DimProduk::all();
        $pelanggans = DimPelanggan::all();
        $waktus = DimWaktu::orderBy('tanggal', 'desc')->get();

        return view('penjualan.create', compact('produks', 'pelanggans', 'waktus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:dim_produk,id_produk',
            'id_pelanggan' => 'required|exists:dim_pelanggan,id_pelanggan',
            'id_waktu' => 'required|exists:dim_waktu,id_waktu',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = DimProduk::findOrFail($request->id_produk);

        FactPenjualan::create([
            'id_produk' => $request->id_produk,
            'id_pelanggan' => $request->id_pelanggan,
            'id_waktu' => $request->id_waktu,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $produk->harga,
            'total_harga' => $produk->harga * $request->jumlah,
        ]);

        return redirect()->route('penjualan.index')->with('success', 'Transaksi penjualan berhasil ditambahkan.');
    }

    public function edit(FactPenjualan $penjualan)
    {
        $produks = DimProduk::all();
        $pelanggans = DimPelanggan::all();
        $waktus = DimWaktu::orderBy('tanggal', 'desc')->get();

        return view('penjualan.edit', compact('penjualan', 'produks', 'pelanggans', 'waktus'));
    }

    public function update(Request $request, FactPenjualan $penjualan)
    {
        $request->validate([
            'id_produk' => 'required|exists:dim_produk,id_produk',
            'id_pelanggan' => 'required|exists:dim_pelanggan,id_pelanggan',
            'id_waktu' => 'required|exists:dim_waktu,id_waktu',
            'jumlah' => 'required|integer|min:1',
        ]);

        $produk = DimProduk::findOrFail($request->id_produk);

        $penjualan->update([
            'id_produk' => $request->id_produk,
            'id_pelanggan' => $request->id_pelanggan,
            'id_waktu' => $request->id_waktu,
            'jumlah' => $request->jumlah,
            'harga_satuan' => $produk->harga,
            'total_harga' => $produk->harga * $request->jumlah,
        ]);

        return redirect()->route('penjualan.index')->with('success', 'Transaksi penjualan berhasil diperbarui.');
    }

    public function destroy(FactPenjualan $penjualan)
    {
        $penjualan->delete();
        return redirect()->route('penjualan.index')->with('success', 'Transaksi penjualan berhasil dihapus.');
    }
}
