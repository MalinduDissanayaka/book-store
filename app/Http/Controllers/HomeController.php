<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Redirect based on user role
     */
    public function redirect()
    {
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect()->route('books.admin.index');
        }
        return redirect()->route('books.index');
    }
}