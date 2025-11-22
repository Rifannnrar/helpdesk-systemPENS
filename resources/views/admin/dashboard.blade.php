@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Dashboard Admin</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelapor</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
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
                            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                <option value="in_progress" {{ $ticket->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="resolved" {{ $ticket->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                            </select>
                        </form>
                    </td>
                    <td>{{ $ticket->created_at->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-sm btn-info">Lihat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($tickets->isEmpty())
        <div class="alert alert-info">
            Belum ada tiket yang dibuat.
        </div>
    @endif
</div>
@endsection