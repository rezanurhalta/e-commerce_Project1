<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>product customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    
    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: white;
            border-right: 1px solid #dee2e6;
            padding: 20px;
            z-index: 100;
        }

        .main-content {
            margin-left: 250px;
            padding: 25px;
        }

        .nav_menu {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .nav_menu li a {
            text-decoration: none;
            color: #333;
            display: block;
            padding: 10px;
            border-radius: 5px;
        }

        .nav_menu li a:hover {
            background-color: #f8f9fa;
        }

        .product-img-container {
            height: 200px;
            overflow: hidden;
        }

        .product-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-light">

    <div class="sidebar">
        <div class="sidebar-header border-bottom pb-3">
            <h4 class="fw-bold text-primary">history customer</h4>
            <p class="text-muted small mb-0">shopping dashboard</p>
        </div>
        <ul class="nav_menu">
            <li><a href="{{ route('customer.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
            <li><a href="{{ route('customer.products') }}" class="fw-bold text-primary bg-light"><i class="bi bi-box-check me-2"></i> Browser Products</a></li>
            <li><a href="{{ route('customer.cart') }}"><i class="bi bi-cart me-2"></i> My carts</a></li>
            <li><a href="{{ route('customer.orders') }}"><i class="bi bi-bag me-2"></i> my orders</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 border rounded shadow-sm">
            <h3 class="mb-0 fw-bold">Products</h3>
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="me-3">
                    <span class="fw-bold d-block">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link btn-sm text-danger p-0 text-decoration-none small">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($products->count() > 0)
            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="card h-100 border-0 shadow-sm overflow-hidden">
                            <div class="product-img-container bg-secondary-subtle">
                                <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->title }}">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-bold text-truncate">{{ $product->title }}</h5>
                                <p class="card-text text-primary fw-bold mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                
                                <div class="mb-3">
                                    @if ($product->stock > 0)
                                        <span class="badge bg-success-subtle text-success border border-success">In Stock: {{ $product->stock }}</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger">Out of Stock</span>
                                    @endif
                                </div>

                                <form action="{{ route('customer.cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                        <i class="bi bi-cart-plus me-2"></i>Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-5">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-5 mt-4 bg-white rounded shadow-sm">
                <i class="bi bi-inbox text-muted display-1"></i>
                <h4 class="mt-3 text-muted">No Products Available</h4>
                <p class="text-muted">Check back later for new items.</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>