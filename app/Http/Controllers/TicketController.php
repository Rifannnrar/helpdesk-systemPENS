<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        // Cek jika method tickets() ada, jika tidak gunakan query manual
        if (method_exists(Auth::user(), 'tickets')) {
            $tickets = Auth::user()->tickets()->latest()->get();
        } else {
            $tickets = Ticket::where('user_id', Auth::id())->latest()->get();
        }
        
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

public function store(Request $request)
{
    $request->validate([
        'kategori' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('tickets', 'public');
    }

    Ticket::create([
        'user_id' => Auth::id(),
        'kategori' => $request->kategori,
        'lokasi' => $request->lokasi,
        'deskripsi' => $request->deskripsi,
        'foto' => $fotoPath,
        'status' => 'open'
    ]);

    return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dibuat!');
}

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        
        // Authorization manual dengan pengecekan method isAdmin()
        $isAdmin = method_exists(Auth::user(), 'isAdmin') ? Auth::user()->isAdmin() : false;
        
        if (Auth::user()->id !== $ticket->user_id && !$isAdmin) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('tickets.show', compact('ticket'));
    }
}