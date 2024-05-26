<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Laravel 9 CURD Application</title>
  </head>
  <body>

  <div class="bg-dark py-3" >
        <h3 class="text-white text-center">Laravel 9 CURD Project</h3>
  </div>

  <div class="container">
  <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{ route('products.index')}}" class="btn btn-dark">Back</a>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card borde-0 shadaow-lg my-4">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Edit Product</h3>
                </div>
                <form enctype="multipart/form-data" action="{{ route('products.update',$product->id) }}" method="post">
                @method('put')
                <!-- csrf is cross platform security used in frontend
                CSRF is a type of security vulnerability  -->
                @csrf
                <div class="card-body">
                <!-- value="{{old('sku')}}" this prevents input from being cleared after incorrect data submission-->
                    <div class="mb-3">
                        <label for="" class="form-label h5">Name</label>
                        <input type="text"  value="{{old('name',$product->name)}}" class=" @error('name') is-invalid @enderror form-control form-control-lg" placeholder="Name" name="name">
                        @error('name')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class=" @error('sku') is-invalid @enderror form-label h5">Sku</label>
                        <input type="text" value="{{old('sku',$product->sku)}}" class="form-control form-control-lg" placeholder="Sku" name="sku">
                        @error('sku')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class=" @error('price') is-invalid @enderror form-label h5">Price</label>
                        <input type="number" value="{{old('price',$product->price)}}" class="form-control form-control-lg" placeholder="Price" name="price">
                        @error('price')
                            <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label h5">Description</label>
                        <textarea class="form-control" name="description"  cols="30" rows="5" placeholder="Product Description" {{old('description',$product->description) }}></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label h5">Product Image</label>
                        <input type="file" class="form-control form-control-lg" placeholder="Product Image" name="image">
                        @if ($product->image != "")
                                    <img class="w-50 my-3" src="{{ asset('uploads/products/'.$product->image) }}" alt="">
                        @endif
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-lg btn-primary">Update</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

  </div>

  <footer class="bg-dark text-white text-center py-4">
    <div class="container">
        <p class="mb-0">&copy; 2024 Project by Vaibhav Singh</p>
    </div>
</footer>
 
  </body>
</html>