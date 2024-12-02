@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Detail Penyewa</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nama Penyewa: {{ $penyewa->nama }}</h5>
                <p><strong>Tanggal Sewa:</strong> {{ $penyewa->tanggal_sewa }}</p>
                <p><strong>Durasi Sewa:</strong> {{ $penyewa->durasi_sewa }} bulan</p>
                <p><strong>Jenis Kamar:</strong> {{ $penyewa->jenis_kamar }}</p>

                @if($penyewa->foto)
                    <p><strong>Foto:</strong></p>
                    <img src="{{ asset('foto_penyewa/' . $penyewa->foto) }}" alt="Foto Penyewa" style="width: 150px; height: auto;">
                @else
                    <p><strong>Foto:</strong> Tidak ada foto</p>
                @endif
            </div>

            <div class="card-footer">
                <a href="{{ route('penyewa.index') }}" class="btn btn-secondary">Kembali ke Daftar Penyewa</a>
                <a href="{{ route('penyewa.edit', $penyewa->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('penyewa.destroy', $penyewa->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
