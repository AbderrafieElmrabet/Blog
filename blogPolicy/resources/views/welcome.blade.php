<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-3">
        <h4>Welcome, {{ Auth::user()->name ?? 'Guest' }}!</h4>
    </div>
    <div class="container mt-5">
        <h2 class="mb-4">{{__('message.List of Articles')}}</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#productModal">
            {{__('message.create blog')}}
        </button>
        <div class="container mt-5">
            <table class="table table-bordered" id="productTable">
                <thead class="table-dark">
                    <tr>
                        <th>Username</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Uploaded at</th>
                        <th>Views</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                    <tr id="product-{{ $blog->id }}">
                        <td>{{ $blog->user->name }}</td>
                        <td>{{ $blog->title }}</td>
                        <td class="text-truncate" style="max-width: 300px;">{{ $blog->content }}</td>
                        <td>{{ $blog->created_at }}</td>
                        <td>{{ $blog->stock }}</td>
                        <td>
                            @can('delete', $blog)
                            <button class="btn btn-danger btn-sm delete-product" data-id="{{ $blog->id }}">
                                {{ __('message.delete') }}
                            </button>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">{{__('message.create new blog')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Blog Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" id="content" name="content" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Views</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>
                        <button type="submit" class="btn btn-success">{{__('message.save blog')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#productForm").submit(function(e) {
                e.preventDefault();
                let formData = {
                    _token: $("input[name=_token]").val()
                    , title: $("#title").val()
                    , content: $("#content").val()
                    , stock: $("#stock").val()
                };

                $.ajax({
                    type: "POST"
                    , url: "{{ route('products.store') }}"
                    , data: formData
                    , success: function(response) {
                        $("#productModal").modal("hide");
                        $("#productForm")[0].reset();

                        const createdAt = new Date(response.created_at);

                        const formattedDate = createdAt.toLocaleString();

                        $("#productTable tbody").append(`
                        <tr id="product-${response.id}">
                            <td>${response.user.name }</td>
                            <td>${response.title}</td>
                            <td class="text-truncate" style="max-width: 300px;">${response.content}</td>
                            <td>${formattedDate}</td>
                            <td>${response.stock}</td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-product" data-id="${response.id}">
                                    {{ __('message.delete') }}
                                </button>
                            </td>
                        </tr>
                    `);
                    }
                    , error: function(xhr) {
                        alert("Error: " + xhr.responseJSON.message);
                    }
                });
            });

            $(document).on('click', '.delete-product', function() {
                let productId = $(this).data('id');

                if (confirm('Are you sure you want to delete this Blog?')) {
                    $.ajax({
                        type: "DELETE"
                        , url: "/products/" + productId
                        , data: {
                            _token: $("input[name=_token]").val()
                        }
                        , success: function(response) {
                            $("#product-" + productId).remove();
                        }
                        , error: function(xhr) {
                            alert("Error: " + xhr.responseJSON.message);
                        }
                    });
                }
            });
        });

    </script>
</body>
</html>
