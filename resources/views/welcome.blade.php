@extends('layouts.app')

@section('content')
<div class="container mb-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="bg-white p-3 rounded shadow-sm text-center">
                <h3 class="fw-bold">Selamat Datang di PENS Helpdesk</h3>
                <p class="mb-0">Solusi mudah untuk melaporkan dan melacak masalah Anda.</p>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="bg-white p-3 rounded shadow-sm text-center">
                <p>Akses cepat ke fitur-fitur utama.</p>
                <div class="d-grid gap-2 col-md-6 mx-auto">
                    @auth
                        <a class="btn btn-primary btn-md" href="{{ route('tickets.index') }}" role="button">
                            <i class="bi bi-ticket-fill me-2"></i>Lihat Tiket Saya
                        </a>
                        @if(Auth::user()->isAdmin())
                            <a class="btn btn-info btn-md text-white" href="{{ route('admin.dashboard') }}" role="button">
                                <i class="bi bi-speedometer2 me-2"></i>Dashboard Admin
                            </a>
                        @endif
                    @else
                        <a class="btn btn-primary btn-md" href="{{ route('login') }}" role="button">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Login
                        </a>
                        <a class="btn btn-success btn-md" href="{{ route('register') }}" role="button">
                            <i class="bi bi-person-plus-fill me-2"></i>Daftar Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-headset display-6 text-primary mb-3"></i>
                    <h5 class="card-title">Pelaporan Mudah</h5>
                    <p class="card-text">Laporkan masalah Anda dengan cepat dan mudah melalui antarmuka yang intuitif.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-clock-history display-6 text-success mb-3"></i>
                    <h5 class="card-title">Pelacakan Real-time</h5>
                    <p class="card-text">Lacak status tiket Anda secara real-time dari dibuat hingga selesai.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-chat-left-text-fill display-6 text-info mb-3"></i>
                    <h5 class="card-title">Komunikasi Efektif</h5>
                    <p class="card-text">Berkomunikasi langsung dengan tim dukungan untuk solusi cepat.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection