@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center">
    <div class="w-50">  <!-- Makes the form take 50% of the screen width -->
        <h1 class="text-center">Create Author</h1>
        <form id="createAuthorForm">
            <div class="mb-3">
                <label for="authorName" class="form-label">Author Name</label>
                <input type="text" class="form-control" id="authorName" name="authorName">
            </div>
            <div class="mb-3">
                <label for="birth_date" class="form-label">Birth Date</label>
                <input type="date" class="form-control" id="birth_date" name="birth_date">
            </div>
            <button type="submit" class="btn btn-primary w-100" id="authorSubmit">Submit</button>
        </form>
    </div>
</div>
@endsection
