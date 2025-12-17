<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Pemasukan;
use App\Models\Tabungan;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalPemasukan = Pemasukan::where('user_id', $userId)->sum('jumlah');
        $totalPengeluaran = Pengeluaran::where('user_id', $userId)->sum('nominal');
        $sisaUang = $totalPemasukan - $totalPengeluaran;


        $totalPengeluaranBulanIni = Pengeluaran::where('user_id', $userId)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('nominal');

        $totalPengeluaranHariIni = Pengeluaran::where('user_id', $userId)
            ->whereDate('tanggal', today())
            ->sum('nominal');

        $jumlahTransaksi = Pengeluaran::where('user_id', $userId)->count();

        $rataRataPengeluaran = $jumlahTransaksi > 0 
            ? $totalPengeluaranBulanIni / $jumlahTransaksi 
            : 0;

        $pengeluaranTerbaru = Pengeluaran::where('user_id', $userId)
            ->with('kategori')
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $tabungan = Tabungan::where('user_id', $userId)->first();

        $pengeluaranPerKategori = Pengeluaran::where('user_id', $userId)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->with('kategori')
            ->get()
            ->groupBy('kategori.nama')
            ->map(fn($items) => $items->sum('nominal'))
            ->sortDesc()
            ->take(5);

        return view('dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'sisaUang',
            'totalPengeluaranBulanIni',
            'totalPengeluaranHariIni',
            'jumlahTransaksi',
            'rataRataPengeluaran',
            'pengeluaranTerbaru',
            'tabungan',
            'pengeluaranPerKategori'
        ));
    }

}