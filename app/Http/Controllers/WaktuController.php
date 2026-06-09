<?php

namespace App\Http\Controllers;

use App\Models\DimWaktu;
use Illuminate\Http\Request;

class WaktuController extends Controller
{
    public function index()
    {
        $waktus = DimWaktu::orderBy('tanggal', 'desc')->get();
        return view('waktu.index', compact('waktus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date|unique:dim_waktu,tanggal',
            'tahun' => 'required|integer',
            'bulan' => 'required|integer',
            'bulan_nama' => 'required|string',
            'kuartal' => 'required|integer',
        ]);

        DimWaktu::create($request->all());

        return redirect()->route('waktu.index')->with('success', 'Waktu berhasil ditambahkan.');
    }
}
