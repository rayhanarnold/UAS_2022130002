<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyewa;
use Illuminate\Routing\Route;

class PenyewaController extends Controller
{
    public function index()
    {
        $penyewas = Penyewa::paginate(10);
        return view('penyewa.index', compact('penyewas'));
    }

    public function show($id)
    {
        $penyewa = Penyewa::findOrFail($id);
        return view('penyewa.show', compact('penyewa'));
    }
    public function create()
    {
        return view('penyewa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_sewa' => 'required|date',
            'durasi_sewa' => 'required|integer|min:1',
            'jenis_kamar' => 'required|in:Reguler,Deluxe',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $penyewa = new Penyewa();
        $penyewa->nama = $request->nama;
        $penyewa->tanggal_sewa = $request->tanggal_sewa;
        $penyewa->durasi_sewa = $request->durasi_sewa;
        $penyewa->jenis_kamar = $request->jenis_kamar;

        if ($request->hasFile('foto')) {
            $fileName = time().'.'.$request->foto->extension();
            $request->foto->move(public_path('foto_penyewa'), $fileName);
            $penyewa->foto = $fileName;
        }

        $penyewa->save();

        return redirect()->route('penyewa.create')->with('success', 'Data penyewa berhasil ditambahkan.');
    }
    public function edit($id)
{
    $penyewa = Penyewa::findOrFail($id);
    return view('penyewa.edit', compact('penyewa'));
}

// Mengupdate penyewa
public function update(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'tanggal_sewa' => 'required|date',
        'durasi_sewa' => 'required|integer|min:1',
        'jenis_kamar' => 'required|string|in:Reguler,Deluxe',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
    ]);

    // Temukan penyewa berdasarkan ID
    $penyewa = Penyewa::findOrFail($id);
    
    // Update data penyewa
    $penyewa->nama = $request->input('nama');
    $penyewa->tanggal_sewa = $request->input('tanggal_sewa');
    $penyewa->durasi_sewa = $request->input('durasi_sewa');
    $penyewa->jenis_kamar = $request->input('jenis_kamar');

    // Cek apakah ada foto baru yang diunggah
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($penyewa->foto) {
            $file_path = public_path('foto_penyewa/' . $penyewa->foto);
            if (file_exists($file_path)) {
                unlink($file_path); // Menghapus file
            }
            


        }

        // Simpan foto baru
        $file = $request->file('foto');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('foto_penyewa'), $filename);
        $penyewa->foto = $filename;
    }

    // Simpan perubahan
    $penyewa->save();

    return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil diperbarui.');
}
public function destroy($id)
{
    // Temukan penyewa berdasarkan ID
    $penyewa = Penyewa::findOrFail($id);
    
    // Hapus foto jika ada
    if ($penyewa->foto) {
        $file_path = public_path('foto_penyewa/' . $penyewa->foto);
        if (file_exists($file_path)) {
            unlink($file_path); // Menghapus file
        }
    }

    // Hapus penyewa
    $penyewa->delete();

    return redirect()->route('penyewa.index')->with('success', 'Data penyewa berhasil dihapus.');
}

}
