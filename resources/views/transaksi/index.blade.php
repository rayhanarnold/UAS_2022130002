@extends('layouts.app')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
    <a class="navbar-brand" href="#">Transaksi Penyewa Kos</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('penyewa.index') }}">Data Penyewa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('transaksi.index') }}">Daftar Transaksi</a>
            </li>
        </ul>
        <!-- Tombol Logout di pojok kanan -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-link nav-link">Logout</button>
        </form>
    </div>
</nav>
<div class="container">
    <h2>Daftar Transaksi</h2>
    <a class="btn btn-primary mb-3" href="{{ route('transaksi.create') }}">Tambah Data Transaksi</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penyewa</th>
                <th>Tanggal Transaksi</th>
                <th>Total Biaya</th>
                <th>Tanggal Pembayaran</th>
                <th>Jumlah Pembayaran</th>
                <th>Aksi</th> <!-- Tambahkan kolom aksi -->
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksis as $index => $transaksi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaksi->penyewa->nama ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $transaksi->tanggal_transaksi }}</td>
                    <td>Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}</td>
                    <td>{{ $transaksi->tanggal_pembayaran ?? '-' }}</td>
                    <td>Rp {{ number_format($transaksi->jumlah_pembayaran, 0, ',', '.') }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <!-- Form untuk Hapus -->
                        <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data transaksi</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
