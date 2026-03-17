<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="mb-4">
            <a href="{{route('customer.cart')}}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i> Kembali ke Keranjang
            </a>
        </div>

        <form action="{{route('customer.checkout.process')}}" method="POST">
            @csrf
            <div class="row g-4">
                
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            
                            <h5 class="mb-4 fw-bold"><i class="bi bi-truck me-2"></i>Informasi Pengiriman</h5>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="shipping_name" class="form-control" required value="{{Auth::user()->name}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nomor Telepon</label>
                                <input type="tel" name="shipping_phone" class="form-control" required placeholder="08xxxxxxxxxx">
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea name="shipping_address" class="form-control" rows="3" required placeholder="Jalan, Kota, Kode Pos..."></textarea>
                            </div>

                            <hr class="my-4">

                            <h5 class="mb-4 fw-bold"><i class="bi bi-credit-card me-2"></i>Metode Pembayaran</h5>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-check p-3 border rounded shadow-sm">
                                        <input class="form-check-input ms-0 me-2" type="radio" name="payment_method" value="bank_transfer" id="bank" required checked>
                                        <label class="form-check-label fw-medium" for="bank">Transfer Bank</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check p-3 border rounded shadow-sm">
                                        <input class="form-check-input ms-0 me-2" type="radio" name="payment_method" value="e_wallet" id="wallet">
                                        <label class="form-check-label fw-medium" for="wallet">E-Wallet</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check p-3 border rounded shadow-sm">
                                        <input class="form-check-input ms-0 me-2" type="radio" name="payment_method" value="cash_on_delivery" id="cod">
                                        <label class="form-check-label fw-medium" for="cod">COD</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-4">
                            <h5 class="mb-4 fw-bold"><i class="bi bi-card-list me-2"></i>Ringkasan Pesanan</h5>
                            
                            <div class="order-items mb-3">
                                @foreach($cartItems as $item)
                                <div class="d-flex justify-content-between mb-2 small">
                                    <span class="text-muted">{{$item->product->title}} x {{$item->quantity}}</span>
                                    <span>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                                </div>
                                @endforeach
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <span class="fw-bold">Total Bayar</span>
                                <h5 class="text-primary fw-bold mb-0">Rp {{ number_format($total, 0, ',', '.') }}</h5>
                            </div>

                            <button type="submit" class="btn btn-success w-100 py-2 fw-bold">
                                Make Order <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const paymentOptions = document.querySelectorAll('.payment-option');
        paymentOptions.forEach(option => {
            option.addEventListener('click', () => {
                paymentOptions.forEach(opt.classList.remove('selected'));
                    option.classList.add('selected');
            });
        });
        document.querySelector('.payment-option input[type="radio"]').addEventListener('change', function() {
            paymentOptions.forEach(opt => opt.classList.remove('selected'));
            this.parentElement.classList.add('selected');
        });
    </script>
</body>
</html>
 