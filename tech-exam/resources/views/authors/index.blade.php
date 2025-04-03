@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Authors</h1>
    <a href="{{ route('createAuthor') }}" class="btn btn-primary" >Add New Author</a>
    <table id="authorTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Birthdate</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    
        </tbody>
    </table>
</div>
@endsection