<div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
    <ul class="nav nav-secondary">
        <li class="nav-item active">
        <a
            href="/"
        >
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
        </a>
        </li>
        <li class="nav-section">
        <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
        </span>
        <h4 class="text-section">Components</h4>
        </li>
        <li class="nav-item">
        <a href="{{route('buku.index')}}">
            <i class="fas fa-desktop"></i>
            <p>Books</p>
            {{-- <span class="badge badge-success">4</span> --}}
        </a>
        </li>
        <li class="nav-item">
        <a href="{{route('anggota.index')}}">
            <i class="fas fa-desktop"></i>
            <p>Anggota</p>
            {{-- <span class="badge badge-success">4</span> --}}
        </a>
        </li>
        <li class="nav-item">
        <a href="{{route('peminjaman.index')}}">
            <i class="fas fa-desktop"></i>
            <p>Peminjaman</p>
            {{-- <span class="badge badge-success">4</span> --}}
        </a>
        </li>
    </ul>
    </div>
</div>