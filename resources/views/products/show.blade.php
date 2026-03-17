<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>tampilan produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Detail Products</h3>
                    <hr>
                </div>
                <div class="card-bordered-13 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('products.index') }}">Kembali</a>
                        <div class="mb-3 text-center">
                            <img src="{{ asset('storage/products/' . $product->image) }}" class="rounded" style="width: 300px">
                        </div>
                        <div class="mb-3">
                            <h5>Title</h5>
                            <p>{{ $product->title }}</p>
                        </div>
                        <code class="mb-3">
                            <h5>Description</h5>
                            <p>{!! $product->description !!}</p>
                        </code>
                        <div class="mb-3">
                            <h5>Harga</h5>
                            <p>{{"Rp" .number_format($product->price, 2, ',', '.') }}</p>
                        </div>
                        <div class="mb-3">
                            <h5>Stock</h5>
                            <p>{{ $product->stock }}</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>