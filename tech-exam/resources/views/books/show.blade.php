@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="text-center">{{ $book->title }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Book Title:</strong> {{ $book->title }}</p>
            <p><strong>Author:</strong> {{ $book->author->name }}</p>
            <p><strong>Date Published:</strong> {{ \Carbon\Carbon::parse($book->published_date)->format('F d, Y') }}</p>
            <p><strong>Created At:</strong> {{ \Carbon\Carbon::parse($book->created_at)->format('F d, Y h:i:s A') }}</p>
            <p><strong>Updated At:</strong> {{ \Carbon\Carbon::parse($book->updated_at)->format('F d, Y h:i:s A') }}</p>

            <div class="d-flex gap-2">
                <a href="{{ url('/books') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>

@endsection
