<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil ID kategori pemasukan (Gaji, Bonus, Investasi, dll)
        $kategoriMasuk = Kategori::whereIn('nama', ['Gaji', 'Bonus', 'Investasi'])
            ->pluck('id')
            ->toArray();

        // Total pemasukan
        $totalMasuk = Transaksi::where('user_id', $userId)
            ->whereIn('kategori_id', $kategoriMasuk)
            ->sum('nominal');

        // Total pengeluaran
        $totalKeluar = Transaksi::where('user_id', $userId)
            ->whereNotIn('kategori_id', $kategoriMasuk)
            ->sum('nominal');

        // Total akhir
        $total = $totalMasuk - $totalKeluar;

        // Jumlah transaksi
        $count = Transaksi::where('user_id', $userId)->count();

        // Rata-rata
        $rata = $count > 0 ? $total / $count : 0;

        $transaksiTerbaru = Transaksi::where('user_id', $userId)
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        return view('dashboard', compact(
            'total',
            'count',
            'rata',
            'totalMasuk',
            'totalKeluar', 
            'transaksiTerbaru'
        ));
    }
}