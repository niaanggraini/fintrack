<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Transaksi::where('user_id', Auth::id())
            ->with('kategori')
            ->orderBy('tanggal', 'desc');

        if (request()->has('filter')) {
            $filter = request()->filter;

            if ($filter == 'today') {
                $query->whereDate('tanggal', today());
            } elseif ($filter == 'week') {
                $query->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()]);
            } elseif ($filter == 'month') {
                $query->whereMonth('tanggal', now()->month)
                      ->whereYear('tanggal', now()->year);
            }
        }

        $transaksis = $query->get();

        $ringkasanHarian = Transaksi::where('user_id', Auth::id())
            ->whereDate('tanggal', today())
            ->sum('nominal');

        return view('transaksi.index', compact('transaksis', 'ringkasanHarian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $favoriteCategory = Auth::user()->favorite_category;

        return view('transaksi.create', compact('kategoris', 'favoriteCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'keterangan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        Transaksi::create([
            'user_id' => Auth::id(),
            'kategori_id' => $request->kategori_id,
            'keterangan' => $request->keterangan,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        if ($transaksi->user_id !== Auth::id()) {
            abort(403);
        }

        $kategoris = Kategori::all();

        return view('transaksi.edit', compact('transaksi', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        if ($transaksi->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'keterangan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        if ($transaksi->user_id !== Auth::id()) {
            abort(403);
        }

        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus!');
    }
}
