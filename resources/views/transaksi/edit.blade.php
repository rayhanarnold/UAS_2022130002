@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Transaksi</h1>
    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="penyewa_id">Penyewa</label>
            <select name="penyewa_id" class="form-control" required>
                @foreach($penyewas as $penyewa)
                    <option value="{{ $penyewa->id }}" {{ $transaksi->penyewa_id == $penyewa->id ? 'selected' : '' }}>
                        {{ $penyewa->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label for="tanggal_transaksi">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" class="form-control" value="{{ $transaksi->tanggal_transaksi }}" required>
        </div>
        
        <div class="form-group">
            <label for="total_biaya">Total Biaya</label>
            <input type="number" name="total_biaya" class="form-control" value="{{ $transaksi->total_biaya }}" readonly required>
        </div>
        
        <div class="form-group">
            <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
            <input type="date" name="tanggal_pembayaran" class="form-control" value="{{ $transaksi->tanggal_pembayaran }}" required>
        </div>
        
        <div class="form-group">
            <label for="jumlah">Jumlah Pembayaran</label>
            <input type="number" name="jumlah_pembayaran" class="form-control" value="{{ $transaksi->jumlah_pembayaran }}" readonly required>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
