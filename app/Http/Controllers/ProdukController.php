<?php

namespace App\Http\Controllers;

use App\Models\DimProduk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = DimProduk::all();
        return view('produk.index', compact('produks'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|unique:dim_produk,kode_produk',
            'nama_produk' => 'required|string|max:100',
            'kategori' => 'required|in:Elektronik,Pakaian,Makanan',
            'harga' => 'required|numeric|min:0',
        ]);

        DimProduk::create($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(DimProduk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, DimProduk $produk)
    {
        $request->validate([
            'kode_produk' => 'required|unique:dim_produk,kode_produk,' . $produk->id_produk . ',id_produk',
            'nama_produk' => 'required|string|max:100',
            'kategori' => 'required|in:Elektronik,Pakaian,Makanan',
            'harga' => 'required|numeric|min:0',
        ]);

        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(DimProduk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
