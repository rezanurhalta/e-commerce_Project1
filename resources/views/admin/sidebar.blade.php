{{-- <div class="sidebar">
    <div class="sidebar-header">
        <h4>Admin panel</h4>
        <p>Management System</p>
    </div>
    <ul class="nav-manu">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard')}}" class="nav-link {{request()->routeIs('admin.dashboard') ? 'active' : ''}}">
                <i  class="bi bi-speedometer2"></i>Dashboard</a>

        </li>
        <li>
            <li class="nav-item">
                <a href="{{route('products.index')}}" class="nav-link {{request()->routeIs('product.*') ? 'active' : ''}}">
                    <i class="bi bi-speedometer"></i>Product  management</a>
            </li>
        </li>
         <li>
            <li class="nav-item">
                <a href="{{route('admin.orders.index')}}" class="nav-link {{request()->routeIs('admin.orders.*') ? 'active' : ''}}">
                    <i class="bi bi-speedometer2"></i>manage order</a>
            </li>
        </li>
         <li>
            <li class="nav-item">
                <a href="{{route('admin.sales')}}" class="nav-link {{request()->routeIs('admin.sales.*') ? 'active' : ''}}">
                    <i class="bi bi-speedometer2"></i>sales order</a>
            </li>
        </li>
    </ul>
</div> --}}
<div class="d-flex flex-column p-3 bg-light border-end" style="width: 250px; height: 100vh; position: fixed;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
        <span class="fs-4 fw-bold">Admin Panel</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : 'link-dark' }}">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('products.index') }}"
                class="nav-link {{ request()->routeIs('products.*') ? 'active' : 'link-dark' }}">
                <i class="bi bi-box me-2"></i> Products
            </a>
        </li>
        <li>
            <a href="{{ route('admin.orders.index') }}"
                class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : 'link-dark' }}">
                <i class="bi bi-cart me-2"></i> Orders
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.sales') }}"
                class="nav-link {{ request()->routeIs('admin.sales*') ? 'active bg-primary text-white' : 'link-dark' }}">
                <i class="bi bi-graph-up me-2"></i> Sales
            </a>
        </li>
    </ul>
    <hr>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger btn-sm w-100 text-start">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
    </form>
</div>
