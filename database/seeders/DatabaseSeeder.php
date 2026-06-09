<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder Dim Produk
        $produk = [
            ['kode_produk' => 'PRD-001', 'nama_produk' => 'Laptop Asus', 'kategori' => 'Elektronik', 'harga' => 8500000],
            ['kode_produk' => 'PRD-002', 'nama_produk' => 'Kemeja Flanel', 'kategori' => 'Pakaian', 'harga' => 150000],
            ['kode_produk' => 'PRD-003', 'nama_produk' => 'Keripik Kentang', 'kategori' => 'Makanan', 'harga' => 25000],
            ['kode_produk' => 'PRD-004', 'nama_produk' => 'Smartphone Samsung', 'kategori' => 'Elektronik', 'harga' => 4500000],
            ['kode_produk' => 'PRD-005', 'nama_produk' => 'Jaket Denim', 'kategori' => 'Pakaian', 'harga' => 300000],
        ];
        \Illuminate\Support\Facades\DB::table('dim_produk')->insert($produk);

        // Seeder Dim Pelanggan
        $pelanggan = [
            ['kode_pelanggan' => 'CUST-01', 'nama_pelanggan' => 'Budi Santoso', 'jenis_kelamin' => 'L', 'kota' => 'Surabaya'],
            ['kode_pelanggan' => 'CUST-02', 'nama_pelanggan' => 'Siti Aminah', 'jenis_kelamin' => 'P', 'kota' => 'Jakarta'],
            ['kode_pelanggan' => 'CUST-03', 'nama_pelanggan' => 'Agus Setiawan', 'jenis_kelamin' => 'L', 'kota' => 'Bandung'],
            ['kode_pelanggan' => 'CUST-04', 'nama_pelanggan' => 'Rina Melati', 'jenis_kelamin' => 'P', 'kota' => 'Surabaya'],
            ['kode_pelanggan' => 'CUST-05', 'nama_pelanggan' => 'Hendra', 'jenis_kelamin' => 'L', 'kota' => 'Jakarta'],
        ];
        \Illuminate\Support\Facades\DB::table('dim_pelanggan')->insert($pelanggan);

        // Seeder Dim Waktu
        $waktu = [
            ['tanggal' => '2024-01-15', 'tahun' => 2024, 'bulan' => 1, 'bulan_nama' => 'Januari', 'kuartal' => 1],
            ['tanggal' => '2024-05-10', 'tahun' => 2024, 'bulan' => 5, 'bulan_nama' => 'Mei', 'kuartal' => 2],
            ['tanggal' => '2024-08-20', 'tahun' => 2024, 'bulan' => 8, 'bulan_nama' => 'Agustus', 'kuartal' => 3],
            ['tanggal' => '2025-02-14', 'tahun' => 2025, 'bulan' => 2, 'bulan_nama' => 'Februari', 'kuartal' => 1],
            ['tanggal' => '2025-06-25', 'tahun' => 2025, 'bulan' => 6, 'bulan_nama' => 'Juni', 'kuartal' => 2],
        ];
        \Illuminate\Support\Facades\DB::table('dim_waktu')->insert($waktu);

        // Seeder Fact Penjualan
        $fakta = [
            ['id_produk' => 1, 'id_pelanggan' => 1, 'id_waktu' => 1, 'jumlah' => 1, 'harga_satuan' => 8500000, 'total_harga' => 8500000],
            ['id_produk' => 2, 'id_pelanggan' => 2, 'id_waktu' => 1, 'jumlah' => 2, 'harga_satuan' => 150000, 'total_harga' => 300000],
            ['id_produk' => 3, 'id_pelanggan' => 3, 'id_waktu' => 2, 'jumlah' => 5, 'harga_satuan' => 25000, 'total_harga' => 125000],
            ['id_produk' => 4, 'id_pelanggan' => 4, 'id_waktu' => 3, 'jumlah' => 1, 'harga_satuan' => 4500000, 'total_harga' => 4500000],
            ['id_produk' => 5, 'id_pelanggan' => 5, 'id_waktu' => 4, 'jumlah' => 2, 'harga_satuan' => 300000, 'total_harga' => 600000],
            ['id_produk' => 1, 'id_pelanggan' => 3, 'id_waktu' => 5, 'jumlah' => 2, 'harga_satuan' => 8500000, 'total_harga' => 17000000],
            ['id_produk' => 3, 'id_pelanggan' => 1, 'id_waktu' => 2, 'jumlah' => 10, 'harga_satuan' => 25000, 'total_harga' => 250000],
            ['id_produk' => 2, 'id_pelanggan' => 5, 'id_waktu' => 3, 'jumlah' => 1, 'harga_satuan' => 150000, 'total_harga' => 150000],
            ['id_produk' => 4, 'id_pelanggan' => 2, 'id_waktu' => 4, 'jumlah' => 1, 'harga_satuan' => 4500000, 'total_harga' => 4500000],
            ['id_produk' => 5, 'id_pelanggan' => 4, 'id_waktu' => 5, 'jumlah' => 3, 'harga_satuan' => 300000, 'total_harga' => 900000],
        ];
        \Illuminate\Support\Facades\DB::table('fact_penjualan')->insert($fakta);
    }
}
