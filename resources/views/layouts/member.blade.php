<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'VitaGuard') | VitaGuard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--vg-bg);

            /* margin-top: 25px; */
            margin-bottom: 25px;


        }
    </style>


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar py-3 sticky-top" style="background-color: #BFE9CF;">
        <div class="container">
            <a style="color: #3F7F5E; font-weight: bold; font-size: 3vh;">
                VitaGuard
            </a>
            <button class=" navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarBurger">
                <span class="navbar-w-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarBurger">
                <ul class="navbar-nav me-auto ms-lg-4">
                    <li class="nav-item">
                        <a class="nav-link @yield('nav-articles')" href="{{ route('member.articles.index') }}">Artikel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('nav-doctors')" href="{{ route('member.doctors.index') }}">Dokter</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('nav-bookings')" href="{{ route('member.bookings.index') }}">Booking Saya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('nav-consultations')" href="{{ route('member.consultations.index') }}">Konsultasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('nav-history')" href="{{ route('member.history.index') }}">Riwayat</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">


                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle fs-4 text-secondary me-1"></i>
                            <span class="fw-semibold text-dark d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><span class="dropdown-item-text text-muted small">{{ Auth::user()->email }}</span></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>


    <div class="container">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @yield('content')
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    @stack('modals')
</body>

</html>