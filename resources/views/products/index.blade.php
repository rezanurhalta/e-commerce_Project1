<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tugas Data Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                
                <h3 class="text-center my-4">Daftar Produk Toko</h3>
                
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <a href="{{ route('products.create') }}" class="btn btn-success">
                                 + Tambah Produk
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="text-secondary text-decoration-none">
                                kembali ke Dashboard
                            </a>
                        </div>

                        <table class="table table-hover table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Gambar</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('storage/products/' . $product->image) }}" class="rounded shadow-sm" style="width: 100px; height: auto;">
                                    </td>
                                    <td class="align-middle fw-bold">{{ $product->title }}</td>
                                    <td class="align-middle">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="align-middle">{{ $product->stock }}</td>
                                    <td class="align-middle text-muted small">{{ Str::limit(strip_tags($product->description), 50) }}</td>
                                    <td class="text-center align-middle">
                                        <form onsubmit="return confirm('Apakah Anda Yakin?');" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-dark">Detail</a>
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <div class="alert alert-warning mb-0">
                                            Data Produk belum tersedia.
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                        <div class="mt-3">
                            {{ $products->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
</body>
</html>