@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Data Transaksi</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <form action="{{ route('transaksi.store') }}" method="POST" 
    enctype="multipart/form-data">
        
        @csrf
        <div class="form-group">
            <label for="penyewa_id">Nama Penyewa</label>
            <select name="penyewa_id" id="penyewa_id" class="form-control" required>
                <option value="">Pilih Penyewa</option>
                @foreach($penyewas as $p)
                <option value="{{ $p->id }}" 
                        data-jenis_kamar="{{ $p->jenis_kamar }}" 
                        data-durasi_sewa="{{ $p->durasi_sewa }}">
                        {{ $p->nama }}
                    </option>
                @endforeach
            </select>
        </div>
 <!-- Input Tanggal Transaksi -->
 <div class="form-group">
            <label for="tanggal_transaksi">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" class="form-control" required>
        </div>

        <!-- Input Total Biaya -->
        <div class="form-group">
            <label for="total_biaya">Total Biaya</label>
            <input type="number" name="total_biaya" id="total_biaya" class="form-control" step="0.01" readonly required>
        </div>

        <!-- Input Tanggal Pembayaran -->
        <div class="form-group">
            <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
            <input type="date" name="tanggal_pembayaran" class="form-control">
        </div>

        <!-- Input Jumlah Pembayaran -->
        <div class="form-group">
            <label for="jumlah_pembayaran">Jumlah Pembayaran</label>
            <input type="number" name="jumlah_pembayaran" id="jumlah_pembayaran" class="form-control" step="0.01" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script>
    document.getElementById('penyewa_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const jenisKamar = selectedOption.getAttribute('data-jenis_kamar');
        const durasiSewa = parseFloat(selectedOption.getAttribute('data-durasi_sewa'));

        let totalBiaya = 0;

        // Menentukan biaya berdasarkan jenis kamar
        if (jenisKamar === 'Reguler') {
            totalBiaya = 1200000;
        } else if (jenisKamar === 'Deluxe') {
            totalBiaya = 2200000;
        }

        // Menghitung total biaya berdasarkan durasi sewa
        document.getElementById('total_biaya').value = totalBiaya;
        document.getElementById('jumlah_pembayaran').value = totalBiaya * durasiSewa;
    });
</script>
@endsection