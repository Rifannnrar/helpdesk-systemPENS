@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Tiket Saya</h2>
    <a href="{{ route('tickets.create') }}" class="btn btn-primary mb-3">Buat Tiket Baru</a>
    
    <div class="row">
        @foreach($tickets as $ticket)
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $ticket->kategori }}</h5>
                    <p class="card-text">{{ Str::limit($ticket->deskripsi, 100) }}</p>
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
                    <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-primary">Lihat Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection