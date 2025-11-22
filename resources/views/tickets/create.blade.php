@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Tiket Baru</h2>
    <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori Masalah</label>
            <select class="form-select" id="kategori" name="kategori" required>
                <option value="">Pilih Kategori</option>
                <option value="AC Rusak">AC Rusak</option>
                <option value="Proyektor Mati">Proyektor Mati</option>
                <option value="Kursi Rusak">Kursi Rusak</option>
                <option value="Lampu Mati">Lampu Mati</option>
                <option value="Jaringan Internet">Jaringan Internet</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
        </div>
        
        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Masalah</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
        </div>
        
        <div class="mb-3">
            <label for="foto" class="form-label">Upload Foto (Opsional)</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        </div>
        
        <button type="submit" class="btn btn-primary">Submit Tiket</button>
    </form>
</div>
@endsection