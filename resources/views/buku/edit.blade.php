@extends('layouts.app')

@section('menu-buku-active', 'active')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Edit Buku</h4>
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
                    <a href="{{ route('buku.index') }}">Buku</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Edit Buku</div>
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

                        <form action="{{ route('buku.update', $buku->id_buku) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="judul" class="form-label">Judul Buku <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    id="judul" name="judul" value="{{ old('judul', $buku->judul) }}"
                                    placeholder="Masukkan judul buku" required>
                                @error('judul')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pengarang" class="form-label">Pengarang <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('pengarang') is-invalid @enderror"
                                    id="pengarang" name="pengarang" value="{{ old('pengarang', $buku->pengarang) }}"
                                    placeholder="Masukkan nama pengarang" required>
                                @error('pengarang')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="penerbit" class="form-label">Penerbit <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('penerbit') is-invalid @enderror"
                                    id="penerbit" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}"
                                    placeholder="Masukkan nama penerbit" required>
                                @error('penerbit')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="stok" class="form-label">Stok <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                    id="stok" name="stok" value="{{ old('stok', $buku->stok) }}"
                                    placeholder="Masukkan jumlah stok" min="0" required>
                                @error('stok')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tahun_terbit" class="form-label">Tahun Terbit <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('tahun_terbit') is-invalid @enderror"
                                    id="tahun_terbit" name="tahun_terbit"
                                    value="{{ old('tahun_terbit', \Carbon\Carbon::parse($buku->tahun_terbit)->format('Y-m-d')) }}"
                                    required>
                                @error('tahun_terbit')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon-check"></i> Simpan
                                </button>
                                <a href="{{ route('buku.index') }}" class="btn btn-secondary">
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
