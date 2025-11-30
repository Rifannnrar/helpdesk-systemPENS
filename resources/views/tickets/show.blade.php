@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-lg border-0 rounded-lg mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0"><i class="bi bi-ticket-detailed me-2"></i>Detail Tiket #{{ $ticket->id }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p class="mb-1"><strong><i class="bi bi-tag-fill me-2"></i>Kategori:</strong> {{ $ticket->kategori }}</p>
                        <p class="mb-1"><strong><i class="bi bi-geo-alt-fill me-2"></i>Lokasi:</strong> {{ $ticket->lokasi }}</p>
                        <p class="mb-1">
                            <strong><i class="bi bi-info-circle-fill me-2"></i>Status:</strong> 
                            <span class="badge 
                                @if($ticket->status == 'open') bg-success
                                @elseif($ticket->status == 'in_progress') bg-warning text-dark
                                @elseif($ticket->status == 'resolved') bg-info text-dark
                                @else bg-secondary @endif">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-1"><strong><i class="bi bi-person-fill me-2"></i>Dibuat oleh:</strong> {{ $ticket->user->name }}</p>
                        <p class="mb-1"><strong><i class="bi bi-calendar-event-fill me-2"></i>Dibuat:</strong> {{ $ticket->created_at->format('d M Y, H:i') }}</p>
                        @if ($ticket->updated_at != $ticket->created_at)
                            <p class="mb-1"><strong><i class="bi bi-arrow-repeat me-2"></i>Terakhir Update:</strong> {{ $ticket->updated_at->format('d M Y, H:i') }}</p>
                        @endif
                    </div>
                </div>
                
                <hr>

                <div class="mb-4">
                    <h5><i class="bi bi-file-text-fill me-2"></i>Deskripsi Masalah:</h5>
                    <p class="card-text">{{ $ticket->deskripsi }}</p>
                </div>
                
                @if($ticket->foto)
                <div class="mb-4">
                    <h5><i class="bi bi-image-fill me-2"></i>Foto Terlampir:</h5>
                    <img src="{{ asset('storage/' . $ticket->foto) }}" alt="Foto masalah" class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: contain;">
                </div>
                @endif
            </div>
        </div>

        <!-- Section Komentar -->
        <div class="card shadow-lg border-0 rounded-lg mt-4">
            <div class="card-header bg-secondary text-white py-3">
                <h5 class="mb-0"><i class="bi bi-chat-dots-fill me-2"></i>Komentar</h5>
            </div>
            <div class="card-body">
                @if($ticket->comments->isEmpty())
                    <p class="text-muted">Belum ada komentar untuk tiket ini.</p>
                @else
                    <ul class="list-group list-group-flush mb-4">
                        @foreach($ticket->comments as $comment)
                        <li class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1">{{ $comment->user->name }}</h6>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1">{{ $comment->komentar }}</p>
                        </li>
                        @endforeach
                    </ul>
                @endif

                @if($ticket->status !== 'closed')
                <div class="mt-3">
                    <h6>Tambahkan Komentar Baru</h6>
                    <form action="{{ route('comments.store', $ticket) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea class="form-control @error('komentar') is-invalid @enderror" id="komentar" name="komentar" rows="3" placeholder="Ketik komentar Anda di sini..." required>{{ old('komentar') }}</textarea>
                            @error('komentar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-chat-right-text-fill me-2"></i>Kirim Komentar
                        </button>
                    </form>
                </div>
                @else
                <div class="alert alert-info border-0 rounded-pill text-center" role="alert">
                    <i class="bi bi-info-circle-fill me-2"></i>Tiket ini sudah ditutup. Tidak dapat menambah komentar.
                </div>
                @endif
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('tickets.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle-fill me-2"></i>Kembali ke Daftar Tiket
            </a>
        </div>
    </div>
</div>
@endsection