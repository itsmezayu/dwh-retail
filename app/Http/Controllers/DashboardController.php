<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->input('kategori');

        // Base where clause for filter
        $whereClause = "";
        $bindings = [];
        if ($kategori && $kategori !== 'Semua') {
            $whereClause = "WHERE p.kategori = ?";
            $bindings[] = $kategori;
        }

        // Query 1: Total Penjualan per Produk
        $query1 = "
            SELECT p.nama_produk,
                   SUM(f.jumlah) as total_terjual,
                   SUM(f.total_harga) as total_pendapatan
            FROM fact_penjualan f
            JOIN dim_produk p ON f.id_produk = p.id_produk
            $whereClause
            GROUP BY p.id_produk, p.nama_produk
            ORDER BY total_pendapatan DESC
        ";
        $totalPenjualanPerProduk = DB::select($query1, $bindings);

        // Query 2: Tren Penjualan per Bulan
        $query2 = "
            SELECT w.bulan_nama, w.bulan, w.tahun,
                   SUM(f.total_harga) as total_pendapatan
            FROM fact_penjualan f
            JOIN dim_waktu w ON f.id_waktu = w.id_waktu
            JOIN dim_produk p ON f.id_produk = p.id_produk
            $whereClause
            GROUP BY w.tahun, w.bulan, w.bulan_nama
            ORDER BY w.tahun, w.bulan
        ";
        $trenPenjualanPerBulan = DB::select($query2, $bindings);

        // Query 3: Pelanggan dengan Belanja Tertinggi
        $query3 = "
            SELECT pl.nama_pelanggan,
                   SUM(f.total_harga) as total_belanja,
                   COUNT(f.id_penjualan) as jumlah_transaksi
            FROM fact_penjualan f
            JOIN dim_pelanggan pl ON f.id_pelanggan = pl.id_pelanggan
            JOIN dim_produk p ON f.id_produk = p.id_produk
            $whereClause
            GROUP BY pl.id_pelanggan, pl.nama_pelanggan
            ORDER BY total_belanja DESC
        ";
        $pelangganTertinggi = DB::select($query3, $bindings);

        return view('dashboard.index', compact('totalPenjualanPerProduk', 'trenPenjualanPerBulan', 'pelangganTertinggi', 'kategori'));
    }
}
