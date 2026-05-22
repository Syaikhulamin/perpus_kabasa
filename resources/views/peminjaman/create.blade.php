@extends('layouts.app')

@section('menu-peminjaman-active', 'active')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Tambah Peminjaman</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="{{ route('home') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('peminjaman.index') }}">Peminjaman</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Tambah</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Tambah Peminjaman</div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                <h4 class="alert-heading">Validasi Gagal!</h4>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('peminjaman.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="id_anggota" class="form-label">Anggota <span
                                        class="text-danger">*</span></label>
                                <select name="id_anggota" id="id_anggota"
                                    class="form-control @error('id_anggota') is-invalid @enderror" required>
                                    <option value="">Pilih anggota</option>
                                    @foreach ($anggota as $a)
                                        <option value="{{ $a->id_anggota }}"
                                            @if (old('id_anggota') == $a->id_anggota) selected @endif>
                                            {{ $a->nama }} ({{ $a->kelas }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_anggota')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="id_buku" class="form-label">Buku <span class="text-danger">*</span></label>
                                <select name="id_buku" id="id_buku"
                                    class="form-control @error('id_buku') is-invalid @enderror" required>
                                    <option value="">Pilih buku</option>
                                    @foreach ($buku as $b)
                                        <option value="{{ $b->id_buku }}"
                                            @if (old('id_buku') == $b->id_buku) selected @endif>
                                            {{ $b->judul }} - {{ $b->pengarang }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_buku')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_kembali" class="form-label">Tanggal Kembali <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="tanggal_kembali" id="tanggal_kembali"
                                    class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                    min="{{ date('Y-m-d') }}" value="{{ old('tanggal_kembali') }}" required>
                                @error('tanggal_kembali')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <small class="form-text text-muted">Tanggal pinjam:
                                    <strong>{{ date('d-m-Y') }}</strong></small>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon-plus"></i> Simpan
                                </button>
                                <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
                                    <i class="icon-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
