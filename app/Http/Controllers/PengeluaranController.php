<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
       public function index(Request $request)
        {
            $userId = Auth::id();
            $filter = $request->filter;

            $ringkasanHarian = Pengeluaran::where('user_id', $userId)
                ->whereDate('tanggal', today())
                ->sum('nominal');

            $analisisQuery = Pengeluaran::where('user_id', $userId);

            if ($filter === 'today') {
                $analisisQuery->whereDate('tanggal', today());
            } elseif ($filter === 'week') {
                $analisisQuery->whereBetween('tanggal', [
                    now()->startOfWeek(),
                    now()->endOfWeek()
                ]);
            } elseif ($filter === 'month') {
                $analisisQuery->whereMonth('tanggal', now()->month)
                            ->whereYear('tanggal', now()->year);
            }

            $chartKategori = $analisisQuery
                ->with('kategori')
                ->get()
                ->groupBy('kategori.nama')
                ->map(fn ($row) => $row->sum('nominal'));

            $pengeluarans = Pengeluaran::where('user_id', $userId)
                ->with('kategori')
                ->orderBy('tanggal', 'desc')
                ->get();

            return view('pengeluaran.index', compact(
                'ringkasanHarian',
                'chartKategori',
                'pengeluarans'
            ));
        }




    public function create()
    {
        $kategoris = Kategori::all();
        $favoriteCategory = Auth::user()->favorite_category;

        return view('pengeluaran.create', compact('kategoris', 'favoriteCategory'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'keterangan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        Pengeluaran::create([
            'user_id' => Auth::id(),
            'kategori_id' => $request->kategori_id,
            'keterangan' => $request->keterangan,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan!');
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        if ($pengeluaran->user_id !== Auth::id()) {
            abort(403);
        }

        $kategoris = Kategori::all();

        return view('pengeluaran.edit', compact('pengeluaran', 'kategoris'));
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        if ($pengeluaran->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'keterangan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date',
        ]);

        $pengeluaran->update($request->all());

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil diupdate!');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        if ($pengeluaran->user_id !== Auth::id()) {
            abort(403);
        }

        $pengeluaran->delete();

        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil dihapus!');
    }
}