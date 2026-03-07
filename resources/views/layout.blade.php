<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan KABASA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { min-height: 100vh; display: flex; flex-direction: column; }
        .container { flex: 1; }

        .active { 
            font-style: bold;
            color: white;
            font-size: 120%;
         }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Perpustakaan KABASA</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link @yield('menu-dashboard-active')" href="{{ route('home') }}">Dashboard</a></li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menu-buku-active')" href="{{ route('buku.index') }}">Buku</a></li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menu-anggota-active')" href="{{ route('anggota.index') }}">Anggota</a></li>
                    <li class="nav-item">
                        <a class="nav-link @yield('menu-peminjaman-active')" href="{{ route('peminjaman.index') }}">Peminjaman</a></li>
                </ul>
            </div>
        </div>
    </nav>

    
    <div class="container my-4">
        
        @yield('content')
        
    </div>

    <footer class="bg-light text-center py-3 mt-5">
        <p class="mb-0">&copy; 2026 Perpustakaan</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>