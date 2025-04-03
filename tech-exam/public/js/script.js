$(document).ready(function () {

    $("#authorSubmit").on("click", function (e) {

        e.preventDefault();
        var form = $('#createAuthorForm')[0];
        let formData = new FormData(form);
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
        console.log(formData)
        $.ajax({
            type: "POST",
            url: "/api/authors",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'Authorization': 'Bearer ' + sessionStorage.getItem('token'),
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                Swal.fire({
                    icon: 'success',
                    title: 'New Author Added!',
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/authors'; 
                    }
                });
            },
            error: function(xhr, status, error) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    var errorMessages = '';
                    for (var field in errors) {
                        errorMessages += errors[field].join('<br>');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMessages
                    });
                }
            }
        });
    });

    $('#authorTable').DataTable({
        ajax: {
            url: '/api/authors',
            method: 'GET',
            dataSrc: '',
        },
        order: [[3, 'desc']],
        columns: [
            { data: 'id' },
            { data: 'name' },
            {
                data: 'birth_date',
                render: function (data, type, row) {
                    var date = new Date(data);
                    return date.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                }
            },
            {
                data: 'created_at',
                render: function (data, type, row) {
                    var date = new Date(data);
                    return date.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: false
                    });
                }
            },
            {
                data: 'updated_at',
                render: function (data, type, row) {
                    var date = new Date(data);
                    return date.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: false
                    });
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return "<div class='d-flex gap-2'><a class='btn btn-info viewAuthor' data-id='" + data.id + "'>View</a><a class='btn btn-primary editAuthor' data-id='" + data.id + "'>Edit</a><a class='btn btn-danger deleteAuthor' data-id='" + data.id + "'>Delete</a></div>";
                }
            },
        ]
    });

    $("#authorTable tbody").on("click", "a.editAuthor", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        console.log(id);
        window.location.href = '/edit/author/' + id; 
    });

    $('#authorUpdate').on('click', function(e) {
        e.preventDefault();

        var authorId = $('#authorId').val();
        var name = $('#editAuthorName').val();
        var birth_date = $('#editBirth_date').val();

        var data = {
            name: name,
            birth_date: birth_date
        };
        console.log(data)
        $.ajax({
            url: '/api/authors/' + authorId, 
            method: 'PUT',
            data: data,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Author updated successfully!',
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/authors'; 
                    }
                });
            },
            error: function(xhr, status, error) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    var errorMessages = '';
                    for (var field in errors) {
                        errorMessages += errors[field].join('<br>');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMessages
                    });
                }
            }
        });
    });

    $('#authorTable tbody').on('click', "a.deleteAuthor", function(e) {
        e.preventDefault();
        var authorId = $(this).data("id");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/authors/' + authorId, 
                    method: 'DELETE',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Author deleted successfully!',
                            showConfirmButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/authors'; 
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            var errorMessages = '';
                            for (var field in errors) {
                                errorMessages += errors[field].join('<br>');
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                html: errorMessages
                            });
                        }
                    }
                });
            }
          });
    });

    $('#authorTable tbody').on('click', "a.viewAuthor", function(e) {
        e.preventDefault();
        var authorId = $(this).data("id");

        e.preventDefault();
        var id = $(this).data("id");
        console.log(id);
        window.location.href = '/view/author/' + authorId; 
    });

    $("#bookSubmit").on("click", function (e) {

        e.preventDefault();
        // console.log("ho")
        var form = $('#createBookForm')[0];
        let formData = new FormData(form);
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }
        console.log(formData)
        $.ajax({
            type: "POST",
            url: "/api/books",
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'Authorization': 'Bearer ' + sessionStorage.getItem('token'),
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                console.log(data);
                Swal.fire({
                    icon: 'success',
                    title: 'New Book Added!',
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/books'; 
                    }
                });
            },
            error: function(xhr, status, error) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    var errorMessages = '';
                    for (var field in errors) {
                        errorMessages += errors[field].join('<br>');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMessages
                    });
                }
            }
        });
    });

    $('#bookTable').DataTable({
        ajax: {
            url: '/api/books',
            method: 'GET',
            dataSrc: '',
        },
        order: [[0, 'desc']],
        columns: [
            { data: 'id' },
            { data: 'title' },
            { data: 'author.name' },
            {
                data: 'published_date',
                render: function (data, type, row) {
                    var date = new Date(data);
                    return date.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                }
            },
            {
                data: 'created_at',
                render: function (data, type, row) {
                    var date = new Date(data);
                    return date.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: false
                    });
                }
            },
            {
                data: 'updated_at',
                render: function (data, type, row) {
                    var date = new Date(data);
                    return date.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: false
                    });
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return "<div class='d-flex gap-2'><a class='btn btn-info viewBook' data-id='" + data.id + "'>View</a><a class='btn btn-primary editBook' data-id='" + data.id + "'>Edit</a><a class='btn btn-danger deleteBook' data-id='" + data.id + "'>Delete</a></div>";
                }
            },
        ]
    });

    $("#bookTable tbody").on("click", "a.editBook", function (e) {
        e.preventDefault();
        var id = $(this).data("id");
        console.log(id);
        window.location.href = '/edit/book/' + id; 
    });

    $('#bookUpdate').on('click', function(e) {
        e.preventDefault();

        var bookId = $('#bookId').val();
        // console.log(bookId);
        var bookTitle = $('#editBookTitle').val();
        var bookAuthor = $('#editBookAuthor').val();
        var published_date = $('#editPublished_date').val();

        var data = {
            title: bookTitle,
            author_id: bookAuthor,
            published_date: published_date,
        };
        console.log(data)
        $.ajax({
            url: '/api/books/' + bookId, 
            method: 'PUT',
            data: data,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Author updated successfully!',
                    showConfirmButton: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/books'; 
                    }
                });
            },
            error: function(xhr, status, error) {
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    var errorMessages = '';
                    for (var field in errors) {
                        errorMessages += errors[field].join('<br>');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMessages
                    });
                }
            }
        });
    });

    $('#bookTable tbody').on('click', "a.deleteBook", function(e) {
        e.preventDefault();
        var bookId = $(this).data("id");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/books/' + bookId, 
                    method: 'DELETE',
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Book deleted successfully!',
                            showConfirmButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/books'; 
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            var errorMessages = '';
                            for (var field in errors) {
                                errorMessages += errors[field].join('<br>');
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                html: errorMessages
                            });
                        }
                    }
                });
            }
          });
    });

    $('#bookTable tbody').on('click', "a.viewBook", function(e) {
        e.preventDefault();
        var bookId = $(this).data("id");

        e.preventDefault();
        var id = $(this).data("id");
        console.log(id);
        window.location.href = '/view/book/' + bookId; 
    });




})
