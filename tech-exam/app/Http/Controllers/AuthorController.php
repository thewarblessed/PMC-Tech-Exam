<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Author::with('books')->orderBy('created_at', 'desc')->get(), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'authorName' => 'required|regex:/^[a-zA-Z\s]+$/',
            'birth_date' => 'required|date',
        ]);

        $author = Author::create([
            'name' => $request->authorName,
            'birth_date' => $request->birth_date,
        ]);

        return response()->json(['message' => "Author Created Successfully", $author, 200]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $author = Author::findOrFail($id);
        return view('authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $author = Author::findOrFail($id);
        return view('authors.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',
            'birth_date' => 'required|date',
        ]);

        $author = Author::findOrFail($id);
        $author->update([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
        ]);

        return response()->json($author, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Author::findOrFail($id)->delete();
        return response()->json(['message' => 'Author deleted'], 200);
    }
}
