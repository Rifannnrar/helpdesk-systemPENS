<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Ticket $ticket)
    {
        $request->validate([
            'komentar' => 'required|string'
        ]);

        Comment::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'komentar' => $request->komentar
        ]);

        return back()->with('success', 'Komentar berhasil ditambahkan!');
    }
}