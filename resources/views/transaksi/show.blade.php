@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Detail Transaksi</h2>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nama Penyewa: {{ $transaksi->penyewa->nama_penyewa }}</h5>
                <p><strong>Tanggal Transaksi:</strong> {{ $transaksi->tanggal_transaksi }}</p>
                <p><strong>Total Biaya:</strong> Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}</p>
                <p><strong>Tanggal Pembayaran:</strong> {{ $transaksi->tanggal_pembayaran }}</p>
                <p><strong>Jumlah:</strong> {{ $transaksi->jumlah }}</p>
            </div>

            <div class="card-footer">
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Kembali ke Daftar Transaksi</a>
                <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Hapus</button>
                </form>
            </div>
        </div>
    </div>
@endsection
