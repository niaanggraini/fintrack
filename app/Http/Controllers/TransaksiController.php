<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function create()
    {
        // Kirim semua kategori ke view
        $kategoris = Kategori::all();
        
        return view('transaksi.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'keterangan'  => 'required|string',
            'nominal'     => 'required|numeric|min:0',
            'tanggal'     => 'required|date',
        ]);

        Transaksi::create([
            'user_id'     => Auth::id(),
            'kategori_id' => $request->kategori_id,
            'keterangan'  => $request->keterangan,
            'nominal'     => $request->nominal,
            'tanggal'     => $request->tanggal,
        ]);

        return redirect()
    ->route('dashboard')
    ->with('success', 'Transaksi berhasil ditambahkan');
    }
}