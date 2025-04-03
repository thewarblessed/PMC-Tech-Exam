<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Author;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Book::with('author')->get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'bookTitle' => 'required',
            'author_id' => 'required|exists:authors,id',
            'published_date' => 'required|date',

        ]);

        $book = Book::create([
            'title' => $request->bookTitle,
            'author_id' => $request->author_id,
            'published_date' => $request->published_date,
            
        ]);

        return response()->json(['message' => "Book Created Successfully", $book, 200]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // Fetch the book with its author details
        $book = Book::with('author')->findOrFail($id);

        // Fetch all authors for the dropdown
        $authors = Author::all();

        // Pass both the book and authors to the view
        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'published_date' => 'required|date',
        ]);

        $book = Book::findOrFail($id);
        $book->update([
            'title' => $request->title,
            'author_id' => $request->author_id,
            'birth_date' => $request->published_date,
        ]);

        return response()->json($book, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Book::findOrFail($id)->delete();
        return response()->json(['message' => 'Book deleted'], 200);
    }
}
