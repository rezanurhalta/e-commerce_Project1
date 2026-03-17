<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    
    <style>
        body { background-color: #f8f9fa; }
        
        /* Layout Sederhana */
        .main-content {
            margin-left: 260px;
            padding: 30px;
        }

        /* Jika layar HP, margin kiri hilang */
        @media (max-width: 768px) {
            .main-content { margin-left: 0; }
        }

        /* Penyesuaian tampilan saat diprint (opsional) */
        @media print {
            .sidebar, .btn, .card-body form { display: none; }
            .main-content { margin-left: 0; padding: 0; }
        }
    </style>
</head>
<body>

    @include('admin.sidebar')

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4">Laporan Penjualan</h2>
            <button onclick="window.print()" class="btn btn-secondary btn-sm">
                <i class="bi bi-printer"></i> Cetak Laporan
            </button>
        </div>

        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <form action="{{route('admin.sales')}}" method="GET" class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Periode Laporan</label>
                        <select name="period" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="all" {{ $period == 'all' ? 'selected' : '' }}>Semua Waktu</option>
                            <option value="daily" {{ $period == 'daily' ? 'selected' : '' }}>7 Hari Terakhir</option>
                            <option value="weekly" {{ $period == 'weekly' ? 'selected' : '' }}>30 Hari Terakhir</option>
                            <option value="monthly" {{ $period == 'monthly' ? 'selected' : '' }}>90 Hari Terakhir</option>
                        </select>
                    </div>
                    @if($period != 'all')
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Pilih Tanggal Mulai</label>
                        <input type="date" name="date" class="form-control form-control-sm" value="{{ $date }}" onchange="this.form.submit()">
                    </div>
                    @endif
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm w-100">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <h5 class="mb-3 text-muted">{{ $title }}</h5>

        <div class="row g-3 mb-4 text-center">
            <div class="col-md-4">
                <div class="p-3 bg-white border rounded shadow-sm">
                    <div class="text-muted small">Total Revenue</div>
                    <div class="h5 fw-bold text-success">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-white border rounded shadow-sm">
                    <div class="text-muted small">Total Orders</div>
                    <div class="h5 fw-bold">{{ $totalOrders }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 bg-white border rounded shadow-sm">
                    <div class="text-muted small">Successful Orders</div>
                    <div class="h5 fw-bold text-primary">{{ $successfulOrders }}</div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">ID Order</th>
                                <th>Customer</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Metode Bayar</th>
                                <th class="text-end pe-3">Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr class="align-middle">
                                <td class="ps-3 text-secondary" style="font-family: monospace;">#{{ $order->id }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <span class="badge bg-{{ $order->status == 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="text-uppercase small">{{ str_replace('_', ' ', $order->payment_method) }}</td>
                                <td class="text-end pe-3 fw-bold">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="bi bi-inbox text-muted fs-2"></i>
                                    <p class="text-muted">Tidak ada data pesanan.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>