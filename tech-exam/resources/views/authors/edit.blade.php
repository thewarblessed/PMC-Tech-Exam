@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center">
    <div class="w-50">  <!-- Makes the form take 50% of the screen width -->
        <h1 class="text-center">Edit Author</h1>
        <form id="editAuthorForm">
            @csrf
            <input type="hidden" id="authorId" value="{{ $author->id }}">
            <div class="mb-3">
                <label for="editAuthorName" class="form-label">Author Name</label>
                <input type="text" class="form-control" id="editAuthorName" name="editAuthorName" value="{{ $author->name }}">
            </div>
            <div class="mb-3">
                <label for="editBirth_date" class="form-label">Birth Date</label>
                <input type="date" class="form-control" id="editBirth_date" name="editBirth_date" value="{{ $author->birth_date }}">
            </div>
            <button type="submit" class="btn btn-primary w-100" id="authorUpdate">Update</button>
        </form>
    </div>
</div>
@endsection
