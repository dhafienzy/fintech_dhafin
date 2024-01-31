<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Fintech</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .card-custom {
            border-radius: 15px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        .card-header-custom {
            background-color: #4CAF50;
            color: white;
            border-radius: 12px 12px 0 0;
        }
        .link-card {
            text-decoration: none;
            color: inherit;
        }
        .header-fintech {
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            margin-bottom: 30px;
        }

        .header-fintech {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
    }

    .header-fintech h1 {
        font-size: 24px; /* Ukuran font lebih kecil */
    }

    .logo-icon {
        font-size: 30px; /* Ukuran logo, sesuaikan jika perlu */
    }
    </style>
</head>
<body>
<div class="header-fintech d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <i class="fas fa-wallet logo-icon"></i> <!-- Contoh menggunakan Font Awesome, ganti dengan logo Anda jika perlu -->
        <h1 class="mb-0 ms-2">Fintech</h1>
    </div>
    <a href="{{ route('login') }}" class="btn btn-outline-light me-3">
        Logout</a>
</div>

    <div class="container">
        <div class="row">
            <!-- Top Up and Canteen for role_id 3 -->
            @if (Auth::user()->role_id === 3)
                <div class="col-md-6 col-lg-4 mb-4">
                    <a href="{{ route('topup') }}" class="link-card">
                        <div class="card card-custom bg-primary text-white text-center">
                            <div class="card-body">
                                <h5 class="card-title">Top Up</h5>
                                <p class="card-text">Silahkan klik untuk Top up</p>
                            </div>
                        </div>
                    </a>
                </div>
                
                <div class="col-md-6 col-lg-4 mb-4">
                    <a href="{{ route('tariktunai') }}" class="link-card">
                        <div class="card card-custom bg-warning text-dark text-center">
                            
                        <div class="card-body">
                                <h5 class="card-title">Tarik tunai</h5>
                                <p class="card-text">Silahkan klik untuk Penarikan</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        </div>
       

    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="background-color: #8DA0F5">
                        <h5>Saldo: {{ $saldo->saldo }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header" style="background-color: #64B9F0; font-weight: bold; color: white">Menu</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($barangs as $barang)
                                <div class="col col-md-3 mt-4" >
                                    <div class="card" style="border-color: black">
                                        <div class="card-body">
                                            <td>
                                                <img width="150" height="80" style="margin: 20px" src={{ asset('assets/images/' . $barang->image) }}
                                                    alt="not found" />
                                            </td>
                                            <div class="card-title">{{ $barang->name }}</div>
                                            <div>
                                                {{ $barang->desc }}
                                                <p>
                                                    Price: {{ $barang->price }}
                                                </p>
                                            </div>
                                        </div>
                                        <form class="m-2" method="POST"
                                            action="{{ route('addToCart', ['id' => $barang->id]) }}">
                                            @csrf
                                            <input type="number" name="jumlah" class="form-control" value="1">
                                            <input type="hidden" name="barang_id" value="{{ $barang->id }}">
                                            <button class="btn btn-primary mt-2" type="submit">Tambah Ke Keranjang</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
            <div class="card">
                <div class="card-header" style="background-color: #64B9F0; font-weight: bold; color: white">keranjang {{ count($carts) > 0 ? '#' . $carts[0]->invoice_id : '' }}</div>
                <div class="card-body">
                    <table class="table table-bordered table-striped" >
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $key => $cart)
                                <tr >
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $cart->barang->name }}</td>
                                    <td>{{ $cart->barang->price }}</td>
                                    <td>{{ $cart->jumlah }}</td>
                                    <td>{{ $cart->barang->price * $cart->jumlah }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">Total : {{ $total_cart }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
                </div>
            </div>
        </div>
        <br/>
            <div class="container">
                <div class="card">
                    <div class="card-header" style="background-color: #64B9F0; font-weight: bold; color: white">Checkout {{ count($carts) > 0 ? '#' . $carts[0]->invoice_id : '' }}</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($checkouts as $key => $checkout)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $checkout->barang->name }}</td>
                                        <td>{{ $checkout->barang->price }}</td>
                                        <td>{{ $checkout->jumlah }}</td>
                                        <td>{{ $checkout->barang->price * $checkout->jumlah }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5">Total : {{ $total_checkout }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('bayar') }}" class="btn btn-primary">Beli</a>
                    </div>
                </div>
            </div>
        </div>

       

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
