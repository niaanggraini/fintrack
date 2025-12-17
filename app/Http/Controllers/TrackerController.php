<?php

namespace App\Http\Controllers;

use App\Models\Tracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrackerController extends Controller
{
    // Tampilkan halaman tracker
    public function index()
    {
        $tracker = Tracker::where('user_id', Auth::id())
            ->first(); // Ambil tracker aktif (1 tracker per user)

        return view('tracker.index', compact('tracker'));
    }

    // Form buat tracker baru
    public function create()
    {
        return view('tracker.create');
    }

    // Simpan tracker baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'target' => 'required|numeric|min:0',
            'tanggal_target' => 'required|date|after:today',
        ]);

        Tracker::create([
            'user_id' => Auth::id(),
            'nama' => $request->nama,
            'target' => $request->target,
            'terkumpul' => 0,
            'tanggal_target' => $request->tanggal_target,
        ]);

        return redirect()->route('tracker.index')
            ->with('success', 'Target berhasil dibuat!');
    }

    // Tambah saldo tracker
    public function tambah(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:0',
        ]);

        $tracker = Tracker::where('user_id', Auth::id())->first();

        if (!$tracker) {
            return back()->with('error', 'Tracker tidak ditemukan!');
        }

        $tracker->terkumpul += $request->jumlah;
        $tracker->save();

        return back()->with('success', 'Berhasil menambah Rp ' . number_format($request->jumlah, 0, ',', '.'));
    }

    // Hapus tracker
    public function destroy(Tracker $tracker)
    {
        if ($tracker->user_id !== Auth::id()) {
            abort(403);
        }

        $tracker->delete();

        return redirect()->route('tracker.index')
            ->with('success', 'Tracker berhasil dihapus!');
    }
}