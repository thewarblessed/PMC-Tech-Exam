@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Books</h1>
    <a href="{{ route('createBook') }}" class="btn btn-primary">Add New Book</a>
    <table id="bookTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date Published </th>
                <th>Created at</th>
                <th>Updated at</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
@endsection