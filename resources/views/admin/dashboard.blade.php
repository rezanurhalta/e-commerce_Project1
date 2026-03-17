 {{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>halaman admin</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    @include('admin.sidebar')
    <div class="main-content">
        <div class="top-bar">
            <h2>Dashboard</h2>
            <div class="user-info">
                <div class="user-avatar">
                    {{strtoupper(substr(Auth::user()->name,0,1))}}
                </div>
                <div>
                    <strong>{{ Auth::user()->name}}</strong>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="bi bi-box-seam"></i>
                <h3></h3>
                <p>Total Products</p>
            </div>
        </div>
    </div>
     <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="bi bi-box-cart"></i>
                <h3></h3>
                <p>Total Orders</p>
            </div>
        </div>
    </div>
     <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="bi bi-box-dollar"></i>
                <h3></h3>
                <p>Total Revenue</p>
            </div>
        </div>
    </div>
     <div class="quick-actions">
     
                <h5>quick Action</h5>
                <a href="{{route('products.index')}}" class="action-btn">
                     <i class="bi bi-box-seam"></i>managent product
                </a>
                <a href="{{route('products.create')}}" class="action-btn">
                     <i class="bi bi-box-circle"></i>Add new Products
                </a>
        
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" ></script>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

    @include('admin.sidebar')

    <div style="margin-left: 250px; padding: 20px;">
        
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-2">
            <h2>Dashboard</h2>
            <span>Halo, <strong>{{ Auth::user()->name }}</strong></span>
        </div>

        <div class="row g-3">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Products</h5>
                        <p class="card-text fs-2 fw-bold">120</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text fs-2 fw-bold">45</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Total Revenue</h5>
                        <p class="card-text fs-2 fw-bold">Rp 5.000.000</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h5 class="mb-3">Quick Action</h5>
            <div class="d-grid gap-2 d-md-block">
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary shadow-sm">
                    Lihat Produk
                </a>
                <a href="{{ route('products.create') }}" class="btn btn-outline-success shadow-sm">
                    Tambah Produk Baru
                </a>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>