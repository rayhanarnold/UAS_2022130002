@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Edit Penyewa</h2>

    <form action="{{ route('penyewa.update', $penyewa->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama Penyewa</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $penyewa->nama) }}" required>
        </div>

        <div class="mb-3">
            <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
            <input type="date" class="form-control" id="tanggal_sewa" name="tanggal_sewa" value="{{ old('tanggal_sewa', $penyewa->tanggal_sewa) }}" required>
        </div>

        <div class="mb-3">
            <label for="durasi_sewa" class="form-label">Durasi Sewa (bulan)</label>
            <input type="number" class="form-control" id="durasi_sewa" name="durasi_sewa" value="{{ old('durasi_sewa', $penyewa->durasi_sewa) }}" required>
        </div>

        <div class="mb-3">
            <label for="jenis_kamar" class="form-label">Jenis Kamar</label>
            <select class="form-select" id="jenis_kamar" name="jenis_kamar" required>
                <option value="Reguler" {{ $penyewa->jenis_kamar == 'Reguler' ? 'selected' : '' }}>Reguler</option>
                <option value="Deluxe" {{ $penyewa->jenis_kamar == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto Penyewa</label>
            <input type="file" class="form-control" id="foto" name="foto">
            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('penyewa.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
