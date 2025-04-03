@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center">
    <div class="w-50">  <!-- Makes the form take 50% of the screen width -->
        <h1 class="text-center">Create Book</h1>
        <form id="createBookForm">
            <div class="mb-3">
                <label for="bookTitle" class="form-label">Book Title</label>
                <input type="text" class="form-control" id="bookTitle" name="bookTitle">
            </div>
            {{-- <div class="mb-3">
                <label for="bookAuthor" class="form-label">Author</label>
                <input type="text" class="form-control" id="bookAuthor">
            </div> --}}
            <div class="mb-3">
                <label for="bookAuthor" class="form-label">Author</label>
                <select class="form-select" name="author_id" aria-label="Default select example">
                    <option selected disabled>Select an Author</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="published_date" class="form-label">Date Published</label>
                <input type="date" class="form-control" id="published_date" name="published_date">
            </div>
            <button type="submit" class="btn btn-primary w-100" id="bookSubmit">Submit</button>
        </form>
    </div>
</div>
@endsection
