@extends('layouts.app')

@section('content')


<nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
        <a class="navbar-brand" href="#">Penyewa Kos</a>
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
        <h2 class="my-4">Daftar Penyewa Kos</h2>

        <!-- Tombol untuk menambahkan penyewa baru -->
        <a class="btn btn-primary mb-3" href="{{ route('penyewa.create') }}">Tambah Penyewa Baru</a>

        <!-- Cek apakah ada data penyewa -->
        @if($penyewas->isEmpty())
            <p>Tidak ada data penyewa yang tersedia.</p>
        @else
            <!-- Tabel data penyewa -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Penyewa</th>
                        <th>Tanggal Sewa</th>
                        <th>Durasi Sewa (bulan)</th>
                        <th>Jenis Kamar</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penyewas as $index => $penyewa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $penyewa->nama }}</td>
                            <td>{{ $penyewa->tanggal_sewa }}</td>
                            <td>{{ $penyewa->durasi_sewa }}</td>
                            <td>{{ $penyewa->jenis_kamar }}</td>
                            <td>
                                @if($penyewa->foto)
                                    <img src="{{ asset('foto_penyewa/' . $penyewa->foto) }}" alt="Foto Penyewa" style="width: 50px; height: auto;">
                                @else
                                    Tidak ada foto
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('penyewa.show', $penyewa->id) }}" class="btn btn-info">Lihat</a>
                                <a href="{{ route('penyewa.edit', $penyewa->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('penyewa.destroy', $penyewa->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Pagination links -->
            {{ $penyewas->links() }}
        @endif
    </div>
@endsection
