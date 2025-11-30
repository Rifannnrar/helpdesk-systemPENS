@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0 bg-primary text-white p-2 rounded shadow-sm">Daftar Tiket Saya</h2>
            <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Buat Tiket Baru
            </a>
        </div>

        @if($tickets->isEmpty())
            <div class="alert alert-info" role="alert">
                Tidak ada tiket yang tersedia.
            </div>
        @else
            <div class="row">
                @foreach($tickets as $ticket)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $ticket->kategori }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $ticket->created_at->format('d M Y, H:i') }}</h6>
                            <p class="card-text">{{ Str::limit($ticket->deskripsi, 100) }}</p>
                            <p class="card-text">
                                <strong><i class="bi bi-geo-alt-fill me-1"></i>Lokasi:</strong> {{ $ticket->lokasi }}
                            </p>
                            <p class="card-text">
                                <strong><i class="bi bi-info-circle-fill me-1"></i>Status:</strong> 
                                <span class="badge 
                                    @if($ticket->status == 'open') bg-success
                                    @elseif($ticket->status == 'in_progress') bg-warning text-dark
                                    @elseif($ticket->status == 'resolved') bg-info text-dark
                                    @else bg-secondary @endif">
                                    {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                </span>
                            </p>
                            <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye me-1"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection