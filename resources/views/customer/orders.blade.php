<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>my orders</title>
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
            color: #0d6efd;
        }
    </style>
</head>

<body class="bg-light">

    <div class="sidebar d-none d-md-block">
        <div class="sidebar-header border-bottom pb-3">
            <h4 class="fw-bold text-primary">history customer</h4>
            <p class="text-muted small mb-0">shopping dashboard</p>
        </div>
        <ul class="nav_menu">
            <li><a href="{{ route('customer.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
            <li><a href="{{ route('customer.products') }}"><i class="bi bi-box-check me-2"></i> Browser Products</a></li>
            <li><a href="{{ route('customer.cart') }}"><i class="bi bi-cart me-2"></i> My carts</a></li>
            <li><a href="{{ route('customer.orders') }}" class="fw-bold text-primary bg-light"><i class="bi bi-bag me-2"></i> my orders</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 border rounded shadow-sm">
            <h3 class="mb-0 fw-bold text-dark">Orders history</h3>
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="me-3">
                    <span class="fw-bold d-block">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link btn-sm text-danger p-0 text-decoration-none">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                @if ($orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Total Amount</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="fw-bold">#{{ $order->id }}</td>
                                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                        <td>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                        <td><span class="badge bg-light text-dark border text-uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</span></td>
                                        <td>
                                            @php
                                                $statusClass = [
                                                    'pending' => 'bg-warning text-dark',
                                                    'processing' => 'bg-info text-white',
                                                    'completed' => 'bg-success text-white',
                                                    'cancelled' => 'bg-danger text-white'
                                                ][$order->status] ?? 'bg-secondary';
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('customer.show', $order->id) }}" class="btn btn-primary btn-sm rounded-pill px-3">
                                                <i class="bi bi-eye me-1"></i> View Details
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-clipboard-x text-muted" style="font-size: 4rem;"></i>
                        <h4 class="mt-3 text-muted">You have no orders yet.</h4>
                        <p class="text-muted mb-4">Let's start shopping to see your orders here!</p>
                        <a href="{{ route('customer.products') }}" class="btn btn-primary px-4">
                            <i class="bi bi-cart-fill me-2"></i>Start Shopping
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>