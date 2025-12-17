<?php

namespace App\Http\Controllers;

use App\Models\Tabungan;
use App\Models\HistoriTabungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TabunganController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tabungan user yang sedang login
        $tabungan = Tabungan::where('user_id', Auth::id())
            ->with('historiTabungans')
            ->first();
        
        $histori = [];
        
        if ($tabungan) {
            $query = $tabungan->historiTabungans();
            
            // Filter search
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('catatan', 'like', '%' . $search . '%')
                      ->orWhere('nominal', 'like', '%' . $search . '%');
                });
            }
            
            $histori = $query->orderBy('tanggal', 'desc')->get();
        }
        
        return view('tabungan.index', compact('tabungan', 'histori'));
    }

    public function create()
    {
        // Cek apakah user sudah punya tabungan
        $existingTabungan = Tabungan::where('user_id', Auth::id())->first();
        
        if ($existingTabungan) {
            return redirect()->route('tabungan.index')
                ->with('error', 'Anda sudah memiliki tabungan aktif!');
        }
        
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
        
        // Gunakan user yang sedang login
        $validated['user_id'] = Auth::id();
        $validated['saldo_awal'] = $validated['saldo_awal'] ?? 0;
        $validated['saldo_terkini'] = $validated['saldo_awal'];
        
        Tabungan::create($validated);
        
        return redirect()->route('tabungan.index')
            ->with('success', 'Tabungan berhasil dibuat!');
    }

    public function addHistory($id)
    {
        // Pastikan tabungan milik user yang login
        $tabungan = Tabungan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        return view('tabungan.add-history', compact('tabungan'));
    }

    public function storeHistory(Request $request, $id)
    {
        $validated = $request->validate([
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
            'catatan' => 'required|string|max:255'
        ]);
        
        // Pastikan tabungan milik user yang login
        $tabungan = Tabungan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $validated['tabungan_id'] = $tabungan->id;
        
        HistoriTabungan::create($validated);
        $tabungan->updateSaldoTerkini();
        
        return redirect()->route('tabungan.index')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Untuk edit tabungan
        $tabungan = Tabungan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        return view('tabungan.edit', compact('tabungan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_tabungan' => 'required|string|max:255',
            'target_tabungan' => 'required|numeric|min:0',
            'target_tanggal' => 'required|date',
        ]);
        
        $tabungan = Tabungan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $tabungan->update($validated);
        
        return redirect()->route('tabungan.index')
            ->with('success', 'Tabungan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $tabungan = Tabungan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $tabungan->delete();
        
        return redirect()->route('tabungan.index')
            ->with('success', 'Tabungan berhasil dihapus!');
    }
}