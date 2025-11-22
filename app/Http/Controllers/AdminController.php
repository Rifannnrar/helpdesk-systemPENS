<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Cek apakah user adalah admin
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect('/home')->with('error', 'Akses ditolak. Hanya admin yang bisa mengakses halaman ini.');
        }

        $tickets = Ticket::with('user')->latest()->get();
        return view('admin.dashboard', compact('tickets'));
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        // Cek apakah user adalah admin
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect('/home')->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'status' => 'required|in:open,in_progress,resolved,closed'
        ]);

        $ticket->update(['status' => $request->status]);

        return back()->with('success', 'Status tiket berhasil diupdate!');
    }
}