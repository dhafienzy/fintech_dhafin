<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarik Tunai</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> <!-- Sesuaikan path ke CSS Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome untuk logo -->
    <style>

        body {
            background-color: #f8f9fa;
            font-family: 'Nunito', sans-serif;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        }
        .card-header {
            background-color: #8DA0F5;
            border-radius: 10px 10px 0 0;
            color: white;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #4a69bd;
            border: none;
        }
        .btn-primary:hover {
            background-color: #1e3799;
        }
        header {
        background-color: #4a69bd; /* Warna background header */
    }

    .navbar-light .navbar-brand {
        color: #4a69bd; /* Warna untuk teks Beranda */
        font-size: 1.2rem; /* Ukuran font teks Beranda */
    }

    .navbar-light .navbar-brand:hover {
        color: #1e3799; /* Warna teks Beranda saat di-hover */
    }
    .header-title {
    font-family: 'Arial', sans-serif; /* Ganti dengan font yang diinginkan */
    font-size: 1.5rem; /* Ukuran font yang lebih kecil */
    margin-left: 10px; /* Jarak antara logo dan teks */
}

    .logo-icon {
        font-size: 30px; /* Ukuran logo, sesuaikan jika perlu */
        margin-bottom: 10px;
    }

    .navbar-light .navbar-brand, .navbar-light .nav-link {
        color: #4a69bd;
        font-size: 1.2rem;
    }

    .navbar-light .navbar-brand:hover, .navbar-light .nav-link:hover {
        color: #1e3799;
    }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/home') }}">
            <i class="fas fa-money-bill-wave"></i> Tarik Tunai
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link fw-bold text-primary" href="{{ url('/home') }}">Beranda</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

   
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tarik Tunai</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h4>SALDO : <b>{{ $saldo->saldo }}</b></h4>
                        <form method="POST" action="{{ route('transaksi.tariktunai') }}">
                            @csrf
                            <div class="form-group mt-4">
                                <label>Amount</label>
                                <input type="number" name="jumlah" class="form-control" placeholder="Nominal Input">
                                <input type="hidden" name="type" value="1">
                            </div>
                            <button class="btn btn-primary mt-5" type="submit">Tarik Tunai</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script> <!-- Sesuaikan path ke JavaScript Bootstrap -->
</body>
</html>
