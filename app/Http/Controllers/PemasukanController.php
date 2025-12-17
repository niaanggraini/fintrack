<?php

namespace App\Http\Controllers;
use App\Models\Pemasukan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $pemasukan = Pemasukan::orderBy('tanggal', 'desc')->get();
        $total = $pemasukan->sum('jumlah');
        return view('pemasukan.index', compact('pemasukan', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('pemasukan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'jumlah' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        Pemasukan::create([
            'nama' => $request->nama,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'user_id' => Auth::id(), // <-- tambahkan ini
        ]);


        return redirect()->route('pemasukan.index')->with('success', 'Data pemasukan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemasukan $pemasukan) {
        $pemasukan->delete();
        return redirect()->route('pemasukan.index')->with('success', 'Data pemasukan berhasil dihapus.');
    }
}
