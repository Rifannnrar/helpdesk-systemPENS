@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Detail Tiket #{{ $ticket->id }}</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Kategori:</strong> {{ $ticket->kategori }}</p>
                    <p><strong>Lokasi:</strong> {{ $ticket->lokasi }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge 
                            @if($ticket->status == 'open') bg-success
                            @elseif($ticket->status == 'in_progress') bg-warning
                            @elseif($ticket->status == 'resolved') bg-info
                            @else bg-secondary @endif">
                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Dibuat oleh:</strong> {{ $ticket->user->name }}</p>
                    <p><strong>Dibuat:</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            
            <div class="mb-3">
                <strong>Deskripsi Masalah:</strong>
                <p class="mt-2">{{ $ticket->deskripsi }}</p>
            </div>
            
@if($ticket->foto)
<div class="mb-3">
    <strong>Foto:</strong><br>
    <img src="{{ asset('storage/' . $ticket->foto) }}" alt="Foto masalah" class="img-fluid mt-2" style="max-height: 300px;">
</div>
@endif
        </div>
    </div>

    <!-- Section Komentar -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Komentar</h4>
        </div>
        <div class="card-body">
            @foreach($ticket->comments as $comment)
            <div class="mb-3 p-3 border rounded">
                <strong>{{ $comment->user->name }}</strong>
                <small class="text-muted"> - {{ $comment->created_at->format('d/m/Y H:i') }}</small>
                <p class="mb-0 mt-2">{{ $comment->komentar }}</p>
            </div>
            @endforeach

            @if($ticket->status !== 'closed')
            <form action="{{ route('comments.store', $ticket) }}" method="POST" class="mt-3">
                @csrf
                <div class="mb-3">
                    <label for="komentar" class="form-label">Tambah Komentar</label>
                    <textarea class="form-control" id="komentar" name="komentar" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Kirim Komentar</button>
            </form>
            @else
            <div class="alert alert-info">
                Tiket sudah ditutup. Tidak dapat menambah komentar.
            </div>
            @endif
        </div>
    </div>

    <a href="{{ route('tickets.index') }}" class="btn btn-secondary mt-3">Kembali ke Daftar Tiket</a>
</div>
@endsection