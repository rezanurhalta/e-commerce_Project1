<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    @include('admin.sidebar')
    <div class="main-content ">
        <div class="d-flex align-items-center mb-4 gap-3">

            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> kembali ke order
            </a>
            <h2>Order Details</h2>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    </div>
    <div class="col-md-8">
        <div class="card">
            <h5 class="card-header">Order Information</h5>
            <div class="card-body">
                <h5>Order item</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($order->items ?? [] as $item)
                            <tr>
                                <td>
                                    <div>
                                        <img src="{{ asset('storage/products/' . $item->product->image) }}"
                                            alt="{{ $item->product->name }}" class="img-fluid rounded"
                                            style="width: 100px;">
                                        <span>{{ $item->product->title }}</span>
                                    </div>
                                </td>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp{{ number_format($item->price, 2, '.', ',') }}</td>
                                <td>Rp{{ number_format($item->quantity * $item->price, 2, '.', ',') }}</td>
                            </tr>
                        @endforeach
                        <td colspan="3" class="text-end">Total Hasil</td>
                        <td class="fw-bold">Rp{{ number_format($order->total_amount, 2, '.', ',') }}</td>
                    </tbody>
                </table>
            </div>
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">shipping Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>nama penerima:</label>
                            <div class="fw-bold">{{ $order->shipping_name }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Alamat penerima:</label>
                            <div class="fw-bold">{{ $order->shipping_address }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Telepon penerima:</label>
                            <div class="fw-bold">{{ $order->shipping_phone }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Update Order Summary</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="status" class="form-label">Order Status</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="processing"
                                            {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed"
                                            {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled"
                                            {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                                <div>
                                    <label>payment status</label>
                                    <select name="payment_status" class="form-select">
                                        <option value="unpaid"
                                            {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                        <option value="paid"
                                            {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Update Status</button>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Customer Info</h5>

                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="bg-light rounded-circle p-2 d-flex align-items-center justify-content-center "
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-person-fill fs-4 text-secondary"></i>
                                </div>
                            </div>
                            <div class="fw-bold">{{ $order->customer_name }}</div>
                            <div class="text-muted-small">{{ $order->customer_email }}</div>
                        </div>
                    </div>
                </div>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
