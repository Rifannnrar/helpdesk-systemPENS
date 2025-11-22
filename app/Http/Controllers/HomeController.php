<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // Pastikan user memiliki method isAdmin()
            if (method_exists(Auth::user(), 'isAdmin') && Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('tickets.index');
        }
        
        return redirect()->route('login');
    }
}