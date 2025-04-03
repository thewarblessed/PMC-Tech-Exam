@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3 class="text-center">{{ $author->name }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Author Name:</strong> {{ $author->name }}</p>
            <p><strong>Birth Date:</strong> {{ \Carbon\Carbon::parse($author->birth_date)->format('F d, Y') }}</p>
            <p><strong>Created At:</strong> {{ \Carbon\Carbon::parse($author->created_at)->format('F d, Y h:i:s A') }}</p>
            <p><strong>Updated At:</strong> {{ \Carbon\Carbon::parse($author->updated_at)->format('F d, Y h:i:s A') }}</p>

            <div class="d-flex gap-2">
                <a href="{{ url('/authors') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- <script>
    $(document).ready(function() {
        $(".deleteAuthor").click(function() {
            let authorId = $(this).data("id");

            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/authors/" + authorId,
                        type: "DELETE",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            Swal.fire("Deleted!", response.message, "success")
                                .then(() => {
                                    window.location.href = "{{ route('authors.index') }}";
                                });
                        },
                        error: function() {
                            Swal.fire("Error!", "Something went wrong!", "error");
                        }
                    });
                }
            });
        });
    });
</script> --}}
@endsection
