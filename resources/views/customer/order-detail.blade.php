<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Detail</title>
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

        .item-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 10px;
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
            <li><a href="{{ route('customer.products') }}"><i class="bi bi-box-check me-2"></i> Browser Products</a>
            </li>
            <li><a href="{{ route('customer.cart') }}"><i class="bi bi-bag-check me-2"></i> My carts</a></li>
            <li><a href="{{ route('customer.orders') }}" class="fw-bold text-primary bg-light"><i
                        class="bi bi-cart me-2"></i> my orders</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 border rounded shadow-sm">
            <h3 class="mb-0">Orders detail</h3>
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                    style="width: 35px; height: 35px;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="me-3">
                    <span class="fw-bold d-block">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit"
                            class="btn btn-link btn-sm text-danger p-0 text-decoration-none">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <a href="{{ route('customer.orders') }}" class="btn btn-outline-secondary btn-sm mb-4">
            <i class="bi bi-arrow-left"></i> Back to Orders
        </a>

        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white fw-bold">Order Information</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-muted small d-block">Order ID</label>
                            <span class="fw-medium">{{ $order->order_number }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small d-block">Date Placed</label>
                            <span>{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small d-block">Status</label>
                            <span
                                class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'primary') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="mb-0">
                            <label class="text-muted small d-block">Payment Method</label>
                            <span
                                class="text-uppercase fw-medium small">{{ str_replace('_', ' ', $order->payment_method) }}</span>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white fw-bold">Shipping Details</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="text-muted small d-block">Recipient Name</label>
                            <span class="fw-medium">{{ $order->shipping_name }}</span>
                        </div>
                        <div class="mb-3">
                            <label class="text-muted small d-block">Phone Number</label>
                            <span>{{ $order->shipping_phone }}</span>
                        </div>
                        <div class="mb-0">
                            <label class="text-muted small d-block">Shipping Address</label>
                            <span class="small">{{ $order->shipping_address }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white fw-bold">Order Items</div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Product</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th class="text-end pe-3">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->orderItems as $item)
                                        <tr>
                                            <td class="ps-3">
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/products/' . $item->product->image) }}"
                                                        class="item-image border">
                                                    <span class="fw-medium">{{ $item->product->title }}</span>
                                                </div>
                                            </td>
                                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td class="text-end pe-3 fw-bold">Rp
                                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold ps-3">Grand Total:</td>
                                        <td class="text-end pe-3 fw-bold text-primary fs-5">Rp
                                            {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
