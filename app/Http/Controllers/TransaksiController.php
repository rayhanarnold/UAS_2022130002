<?php

namespace App\Http\Controllers;

use App\Models\Transaksi; // Ubah dari TransaksiModel ke Transaksi
use App\Models\Penyewa; // Import model Penyewa jika perlu
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
   public function index()
{
    $transaksis = Transaksi::with('penyewa')->get(); // Pastikan menggunakan eager loading
    return view('transaksi.index', compact('transaksis'));
}


    public function create()
    {
        $penyewas = Penyewa::all(); // Ambil data penyewa untuk dropdown
        return view('transaksi.create', compact('penyewas'));
    }

   public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'penyewa_id' => 'required|exists:penyewas,id',
            'tanggal_transaksi' => 'required|date',
            'total_biaya' => 'required|numeric',
            'tanggal_pembayaran' => 'required|date',
            'jumlah_pembayaran' => 'required|numeric', // Sesuaikan dengan nama input di form
        ]);

        // Debug: Tampilkan data yang divalidasi
        \Log::info('Validated Data:', $validatedData);

        $transaksi = Transaksi::create($validatedData);

        // Debug: Periksa apakah transaksi tersimpan
        \Log::info('Transaksi tersimpan:', $transaksi->toArray());

        return redirect()->route('transaksi.create')
            ->with('success', 'Transaksi berhasil ditambahkan');
    } catch (\Exception $e) {
        // Log error detail
        \Log::error('Kesalahan Simpan Transaksi: ' . $e->getMessage());
        
        return back()
            ->withErrors(['msg' => $e->getMessage()])
            ->withInput();
    }
}
    
    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.show', compact('transaksi'));
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id); 
        $penyewas = Penyewa::all();
        return view('transaksi.edit', compact('transaksi', 'penyewas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'penyewa_id' => 'required',
            'tanggal_transaksi' => 'required|date',
            'total_biaya' => 'required|numeric',
            'tanggal_pembayaran' => 'required|date',
            'jumlah_pembayaran' => 'required|numeric',
        ]);

        $transaksi = Transaksi::findOrFail($id); 
        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
