@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Penyewa Kos</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('penyewa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama">Nama Penyewa</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        
        <div class="form-group">
            <label for="tanggal_sewa">Tanggal Sewa</label>
            <input type="date" class="form-control" id="tanggal_sewa" name="tanggal_sewa" required>
        </div>
        
        <div class="form-group">
            <label for="durasi_sewa">Durasi Sewa (bulan)</label>
            <input type="number" class="form-control" id="durasi_sewa" name="durasi_sewa" min="1" required>
        </div>
        
        <div class="form-group">
            <label for="jenis_kamar">Jenis Kamar</label>
            <select class="form-control" id="jenis_kamar" name="jenis_kamar" required>
                <option value="Reguler">Reguler</option>
                <option value="Deluxe">Deluxe</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="foto">Foto Penyewa</label>
            <input type="file" class="form-control-file" id="foto" name="foto">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
