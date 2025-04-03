@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center">
    <div class="w-50">  <!-- Makes the form take 50% of the screen width -->
        <h1 class="text-center">Edit Book</h1>
        <form>
            @csrf
            <input type="hidden" id="bookId" value="{{ $book->id }}">
            <div class="mb-3">
                <label for="editBookTitle" class="form-label">Book Title</label>
                <input type="text" class="form-control" id="editBookTitle" value="{{ $book->title }}">
            </div>
            <div class="mb-3">
                <label for="editBookAuthor" class="form-label">Author</label>
                <select class="form-select" name="author_id" id="editBookAuthor" aria-label="Default select example">
                    <option value="">Select Author</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" {{ $author->id == $book->author_id ? 'selected' : '' }}>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="editPublished_date" class="form-label">Date Published</label>
                <input type="date" class="form-control" id="editPublished_date" value="{{ $book->published_date }}">
            </div>
            <button type="submit" class="btn btn-primary w-100" id="bookUpdate">Submit</button>
        </form>
    </div>
</div>
@endsection
