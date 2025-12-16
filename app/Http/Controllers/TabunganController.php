<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use App\Models\HistoriTabungan;
use Illuminate\Http\Request;

class TabunganController extends Controller
{
    public function index(Request $request)
    {
        $tabungan = Tabungan::where('user_id', 1)->with('historiTabungans')->first();
        $histori = [];
        if ($tabungan) {
            $query = $tabungan->historiTabungans();
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('catatan', 'like', '%' . $search . '%')->orWhere('nominal', 'like', '%' . $search . '%');
                });
            }
            $histori = $query->orderBy('tanggal', 'desc')->get();
        }
        return view('tabungan.index', compact('tabungan', 'histori'));
    }

    public function create()
    {
        return view('tabungan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tabungan' => 'required|string|max:255',
            'target_tabungan' => 'required|numeric|min:0',
            'target_tanggal' => 'required|date',
            'saldo_awal' => 'nullable|numeric|min:0'
        ]);
        $validated['user_id'] = 1;
        $validated['saldo_awal'] = $validated['saldo_awal'] ?? 0;
        $validated['saldo_terkini'] = $validated['saldo_awal'];
        Tabungan::create($validated);
        return redirect()->route('tabungan.index')->with('success', 'Tabungan berhasil dibuat!');
    }

    public function addHistory($id)
    {
        $tabungan = Tabungan::findOrFail($id);
        return view('tabungan.add-history', compact('tabungan'));
    }

    public function storeHistory(Request $request, $id)
    {
        $validated = $request->validate([
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'catatan' => 'required|string|max:255'
        ]);
        $tabungan = Tabungan::findOrFail($id);
        $validated['tabungan_id'] = $tabungan->id;
        HistoriTabungan::create($validated);
        $tabungan->updateSaldoTerkini();
        return redirect()->route('tabungan.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }
}