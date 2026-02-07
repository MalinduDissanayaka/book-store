<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class BookController extends Controller
{
    /**
     * Display a listing of the resource for users
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Display admin panel with all books
     */
    public function adminIndex()
    {
        // Only allow admins
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect()->route('books.index')->with('error', 'Unauthorized access');
        }
        $books = Book::all();
        return view('books.admin.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only allow admins
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect()->route('books.index')->with('error', 'Unauthorized access');
        }
        
        return view('books.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only allow admins
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect('/books')->with('error', 'Unauthorized access');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            $imageName = time().'.'.$request->cover_image->extension();
            $request->cover_image->move(public_path('images/books'), $imageName);
            $data['cover_image'] = $imageName;
        }

        Book::create($data);

        return redirect()->route('books.admin.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        // Only allow admins
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect('/books')->with('error', 'Unauthorized access');
        }
        
        return view('books.admin.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        // Only allow admins
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect()->route('books.index')->with('error', 'Unauthorized access');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($book->cover_image) {
                $oldImagePath = public_path('images/books/' . $book->cover_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            
            $imageName = time().'.'.$request->cover_image->extension();
            $request->cover_image->move(public_path('images/books'), $imageName);
            $data['cover_image'] = $imageName;
        }

        $book->update($data);

        return redirect()->route('books.admin.index')->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        // Only allow admins
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect()->route('books.index')->with('error', 'Unauthorized access');
        }

        // Delete image if exists
        if ($book->cover_image) {
            $imagePath = public_path('images/books/' . $book->cover_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $book->delete();

        return redirect()->route('books.admin.index')->with('success', 'Book deleted successfully.');
    }
}