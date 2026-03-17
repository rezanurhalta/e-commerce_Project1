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
            color: #0d6efd;
        }

        .nav-active {
            font-weight: bold;
            color: #0d6efd !important;
            background-color: #f8f9fa;
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
            <li>
                <a href="{{ route('customer.dashboard') }}" class="nav-active">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('customer.products') }}">
                    <i class="bi bi-box-check me-2"></i> Browser Products
                </a>
            </li>
            <li>
                <a href="{{ route('customer.cart') }}">
                    <i class="bi bi-cart me-2"></i> My carts
                </a>
            </li>
            <li>
                <a href="{{ route('customer.orders') }}">
                    <i class="bi bi-bag me-2"></i> my orders
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 border rounded shadow-sm">
            <h3 class="mb-0 fw-bold">Dashboard</h3>
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="me-3">
                    <span class="fw-bold d-block text-capitalize">{{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-link btn-sm text-danger p-0 text-decoration-none small">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4 text-white" style="background-color: #0d6efd;">
            <h2 class="fw-bold">Welcome back, {{ Auth::user()->name }}!</h2>
            <p class="mb-0 opacity-75">You are logged in to your customer dashboard.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>