<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    
    <style>
        /* Style minimalis agar layout tidak berantakan */
        body { background-color: #f8f9fa; }
        
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #fff;
            border-right: 1px solid #dee2e6;
            padding: 20px;
        }

        .main-content {
            margin-left: 250px; /* Memberi ruang untuk sidebar */
            padding: 30px;
        }

        .cart-item-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        /* Menghilangkan bullet point pada menu */
        .nav_menu { list-style: none; padding: 0; }
        .nav_menu li a { 
            display: block; 
            padding: 10px; 
            color: #333; 
            text-decoration: none; 
        }
        .nav_menu li a:hover { background: #e9ecef; border-radius: 5px; }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="mb-4">
            <h4 class="fw-bold text-primary">Customer Hub</h4>
            <p class="text-muted small">Shopping Dashboard</p>
        </div>
        <ul class="nav_menu">
            <li><a href="{{ route('customer.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
            <li><a href="{{ route('customer.products') }}"><i class="bi bi-box-seam me-2"></i> Browse Products</a></li>
            <li><a href="{{ route('customer.cart') }}" class="fw-bold text-primary"><i class="bi bi-cart me-2"></i> My Cart</a></li>
            <li><a href="{{ route('customer.orders') }}"><i class="bi bi-bag me-2"></i> My Orders</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
            <h3>My Cart</h3>
            <div class="d-flex align-items-center">
                <span class="me-3 fw-bold">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if ($cartItems->count() > 0)
            <div class="row">
                <div class="col-md-8">
                    @foreach ($cartItems as $item)
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/products/' . $item->product->image) }}" class="cart-item-img me-3">
                                    <div class="flex">
                                        <h5 class="mb-1">{{ $item->product->title }}</h5>
                                        <p class="text-primary fw-bold mb-0">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                    </div>
                                    
                                    <div class="me-3">
                                        <form action="{{ route('customer.cart.update', $item->id) }}" method="POST" class="d-flex align-items-center">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" 
                                                class="form-control form-control-sm text-center" style="width: 60px;" 
                                                onchange="this.form.submit()">
                                        </form>
                                    </div>

                                    <form action="{{ route('customer.cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0">
                                            <i class="bi bi-trash fs-5"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm text-center p-3">
                        <h5 class="card-title border-bottom pb-2">Order Summary</h5>
                        <div class="d-flex justify-content-between my-3">
                            <span>Subtotal</span>
                            <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 fs-5 fw-bold text-success">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('customer.checkout') }}" class="btn btn-primary w-100 py-2">
                             Checkout
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-cart-x text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3">Your cart is empty</h4>
                <p class="text-muted">Looks like you haven't added anything yet.</p>
                <a href="{{ route('customer.products') }}" class="btn btn-primary mt-2">Start Shopping</a>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>