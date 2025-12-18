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
                ->with('error', 'Anda sudah memiliki tabungan aktif! Selesaikan tabungan yang ada terlebih dahulu.');
        }
        
        return view('tabungan.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_tabungan' => 'required|string|max:255',
            'target_tabungan' => 'required|numeric|min:0',
            'target_tanggal' => 'required|date|after:today',
            'saldo_awal' => 'nullable|numeric|min:0'
        ], [
            'target_tanggal.after' => 'Target tanggal harus setelah hari ini.'
        ]);
        
        // Cek lagi apakah user sudah punya tabungan (double security)
        $existingTabungan = Tabungan::where('user_id', Auth::id())->first();
        
        if ($existingTabungan) {
            return redirect()->route('tabungan.index')
                ->with('error', 'Anda sudah memiliki tabungan aktif!');
        }
        
        // Gunakan user yang sedang login
        $validated['user_id'] = Auth::id();
        $validated['saldo_awal'] = $validated['saldo_awal'] ?? 0;
        $validated['saldo_terkini'] = $validated['saldo_awal'];
        
        Tabungan::create($validated);
        
        return redirect()->route('tabungan.index')
            ->with('success', 'Tabungan berhasil dibuat! Mulai menabung sekarang.');
    }

    public function addHistory($id)
    {
        // Pastikan tabungan milik user yang login
        $tabungan = Tabungan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        // Cek apakah tabungan sudah tercapai
        if ($tabungan->saldo_terkini >= $tabungan->target_tabungan) {
            return redirect()->route('tabungan.index')
                ->with('error', 'Target tabungan sudah tercapai! Tidak bisa menambah transaksi lagi.');
        }
        
        return view('tabungan.add-history', compact('tabungan'));
    }

    public function storeHistory(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nominal' => 'required|numeric|not_in:0',
            'tanggal' => 'required|date|before_or_equal:today',
            'catatan' => 'required|string|max:255'
        ], [
            'nominal.not_in' => 'Nominal tidak boleh 0.',
            'tanggal.before_or_equal' => 'Tanggal tidak boleh di masa depan.'
        ]);
        
        // Pastikan tabungan milik user yang login
        $tabungan = Tabungan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        // Cek apakah tabungan sudah tercapai
        if ($tabungan->saldo_terkini >= $tabungan->target_tabungan) {
            return redirect()->route('tabungan.index')
                ->with('error', 'Target tabungan sudah tercapai! Tidak bisa menambah transaksi lagi.');
        }
        
        $validated['tabungan_id'] = $tabungan->id;
        
        HistoriTabungan::create($validated);
        $tabungan->updateSaldoTerkini();
        
        // Reload data tabungan setelah update
        $tabungan->refresh();
        
        // Cek apakah setelah transaksi ini target tercapai
        if ($tabungan->saldo_terkini >= $tabungan->target_tabungan) {
            return redirect()->route('tabungan.index')
                ->with('success', 'Transaksi berhasil ditambahkan.');
        }
        
        return redirect()->route('tabungan.index')
            ->with('success', 'Transaksi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        // Edit tabungan
        $tabungan = Tabungan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        return view('tabungan.edit', compact('tabungan'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
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
            ->with('success', 'Tabungan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Pastikan tabungan milik user yang login
        $tabungan = Tabungan::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        // Simpan nama tabungan untuk pesan
        $namaTabungan = $tabungan->nama_tabungan;
        
        // Hapus tabungan (histori akan ikut terhapus karena cascade atau manual)
        $tabungan->delete();
        
        return redirect()->route('tabungan.index')
            ->with('success', "Tabungan '{$namaTabungan}' berhasil dihapus! Silakan buat tabungan baru.");
    }
}