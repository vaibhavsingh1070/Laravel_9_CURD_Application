<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Laravel 9 CRUD Application</title>
</head>

<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Laravel 9 CRUD Project</h3>
    </div>

    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.create') }}" class="btn btn-dark">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center mt-4">
            @if (Session::has('success'))
                <div class="col-md-10">
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            @endif
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-2">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Products</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Price</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            @if ($products->isNotEmpty())
                                @foreach ($products as $Product)
                                    <tr>
                                        <td>{{ $Product->id }}</td>
                                        <td>
                                            @if ($Product->image != "")
                                                <img width="55" src="{{ asset('uploads/products/' . $Product->image) }}" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $Product->name }}</td>
                                        <td>{{ $Product->sku }}</td>
                                        <td>{{ $Product->price }}</td>
                                        <td>{{ \Carbon\Carbon::parse($Product->created_at)->format('d M, Y') }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', $Product->id) }}"
                                                class="btn btn-primary">Edit</a>
                                            <a href="#" onclick="deleteProduct({{ $Product->id }});"
                                                class="btn btn-danger">Delete</a>
                                            <form id="delete-product-from-{{ $Product->id }}"
                                                action="{{ route('products.destroy', $Product->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-4 mt-5">
        <div class="container">
            <p class="mb-0">&copy; 2024 Project by Vaibhav Singh</p>
        </div>
    </footer>

    <script>
        function deleteProduct(id) {
            if (confirm("Are you sure you want to delete this product?")) {
                document.getElementById("delete-product-from-" + id).submit();
            }
        }
    </script>
</body>

</html>