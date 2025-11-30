@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card shadow-lg border-0 rounded-lg mb-4">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="mb-0"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</h4>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($tickets->isEmpty())
                    <div class="alert alert-info text-center" role="alert">
                        <i class="bi bi-info-circle-fill me-2"></i>Belum ada tiket yang dibuat.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Pelapor</th>
                                    <th>Kategori</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{ $ticket->id }}</td>
                                    <td>{{ $ticket->user->name }}</td>
                                    <td>{{ $ticket->kategori }}</td>
                                    <td>{{ $ticket->lokasi }}</td>
                                    <td>
                                        <form action="{{ route('admin.updateStatus', $ticket) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm 
                                                @if($ticket->status == 'open') bg-success text-white
                                                @elseif($ticket->status == 'in_progress') bg-warning text-dark
                                                @elseif($ticket->status == 'resolved') bg-info text-dark
                                                @else bg-secondary text-white @endif">
                                                <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                                <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                                <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                                <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>{{ $ticket->created_at->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-info text-white" title="Lihat Detail">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection