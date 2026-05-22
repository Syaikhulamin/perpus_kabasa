@extends('layouts.app')

@section('menu-buku-active', 'active')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Data Buku</h3>
                    <h6 class="op-7 mb-2">Semua Buku Perpustakaan</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('buku.create') }}" class="btn btn-primary btn-round">
                        <i class="fa fa-plus"></i> Tambah Buku
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Tabel Data Buku</div>
                                <div class="card-tools">
                                    <form action="{{ route('buku.index') }}" method="GET" class="d-flex gap-2">
                                        <div class="input-group">
                                            <input type="text" name="search" class="form-control"
                                                placeholder="Cari judul buku..." value="{{ $search }}">
                                            <button class="btn btn-outline-secondary" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                        @if (!empty($search))
                                            <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary">
                                                <i class="fa fa-times"></i> Reset
                                            </a>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Pengarang</th>
                                            <th scope="col">Penerbit</th>
                                            <th scope="col">Tahun</th>
                                            <th scope="col">Stok</th>
                                            <th scope="col" class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($books as $index => $buku)
                                            <tr>
                                                <td>{{ $books->firstItem() + $index }}</td>
                                                <td>
                                                    <span class="badge bg-light text-dark">{{ $buku->judul }}</span>
                                                </td>
                                                <td>{{ $buku->pengarang }}</td>
                                                <td>{{ $buku->penerbit }}</td>
                                                <td>{{ \Carbon\Carbon::parse($buku->tahun_terbit)->format('Y') }}</td>
                                                <td>
                                                    <span
                                                        class="badge 
                                            @if ($buku->stok == 0) bg-danger 
                                            @elseif ($buku->stok < 5) 
                                                bg-warning 
                                            @else 
                                                bg-success @endif">
                                                        {{ $buku->stok }}
                                                    </span>
                                                </td>
                                                <td class="text-end d-flex align-items-center justify-content-end">
                                                    <a href="{{ route('buku.edit', $buku->id_buku) }}"
                                                        class="btn btn-icon btn-link btn-warning op-8 me-1" title="Edit">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('buku.destroy', $buku->id_buku) }}"
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
                        {{ $books->appends(['search' => $search])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                bootstrap.Alert.getOrCreateInstance(el).close();
            });
        }, 3000);
    </script>
@endpush
