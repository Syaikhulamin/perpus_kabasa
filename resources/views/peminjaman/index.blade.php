@extends('layouts.app')

@section('menu-peminjaman-active', 'active')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Data Peminjaman</h3>
                    <h6 class="op-7 mb-2">Transaksi Peminjaman Buku Perpustakaan</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary btn-round">
                        <i class="fa fa-plus"></i> Tambah Peminjaman
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Tabel Data Peminjaman</div>
                                <div class="card-tools">
                                    <form action="{{ route('peminjaman.index') }}" method="GET" class="d-flex gap-2">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Cari nama anggota..." value="{{ $search }}">
                                            <button class="btn btn-outline-secondary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                        @if (!empty($search))
                                            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary">
                                                <i class="fa fa-times"></i> Reset
                                            </a>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Anggota</th>
                                            <th scope="col">Buku</th>
                                            <th scope="col">Tgl Pinjam</th>
                                            <th scope="col">Tgl Kembali</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($peminjamans as $index => $peminjaman)
                                            <tr>
                                                <td>{{ $peminjamans->firstItem() + $index }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-light text-dark">{{ $peminjaman->anggota->nama ?? '-' }}</span>
                                                </td>
                                                <td>{{ $peminjaman->buku->judul ?? '-' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('d-m-Y') }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge 
                                                    @if ($peminjaman->tanggal_kembali < date('Y-m-d')) bg-danger 
                                                    @else 
                                                        bg-success @endif">
                                                        {{ \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->format('d-m-Y') }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if ($peminjaman->status == 'Dipinjam')
                                                        <span class="badge bg-info">{{ $peminjaman->status }}</span>
                                                    @elseif ($peminjaman->status == 'Kembali')
                                                        <span class="badge bg-success">{{ $peminjaman->status }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ $peminjaman->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    @if ($peminjaman->status == 'Dipinjam')
                                                        <form
                                                            action="{{ route('peminjaman.kembali', $peminjaman->id_peminjaman) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')">
                                                            @csrf
                                                            <button class="btn btn-icon btn-link btn-info op-8 me-1"
                                                                title="Kembalikan">
                                                                <i class="fas fa-undo"></i>
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('peminjaman.edit', $peminjaman->id_peminjaman) }}"
                                                            class="btn btn-icon btn-link btn-warning op-8 me-1"
                                                            title="Edit">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                    @endif
                                                    <form
                                                        action="{{ route('peminjaman.destroy', $peminjaman->id_peminjaman) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-icon btn-link btn-danger op-8"
                                                            title="Hapus">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <i class="fas fa-inbox fa-2x text-muted mb-2"></i>
                                                    <p class="text-muted mb-0">Tidak ada data ditemukan</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $peminjamans->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
