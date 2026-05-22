@extends('layouts.app')

@section('menu-anggota-active', 'active')
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Edit Anggota</h4>
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
                    <a href="{{ route('anggota.index') }}">Anggota</a>
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
                        <div class="card-title">Form Edit Anggota</div>
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

                        <form action="{{ route('anggota.update', $anggota->id_anggota) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama', $anggota->nama) }}"
                                    placeholder="Masukkan nama anggota" required>
                                @error('nama')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kelas" class="form-label">Kelas <span class="text-danger">*</span></label>
                                <select name="kelas" id="kelas"
                                    class="form-control @error('kelas') is-invalid @enderror" required>
                                    <option value="">Pilih Kelas</option>
                                    <option value="Kelas X" @if (old('kelas', $anggota->kelas) == 'Kelas X') selected @endif>Kelas X
                                    </option>
                                    <option value="Kelas XI" @if (old('kelas', $anggota->kelas) == 'Kelas XI') selected @endif>Kelas XI
                                    </option>
                                    <option value="Kelas XII" @if (old('kelas', $anggota->kelas) == 'Kelas XII') selected @endif>Kelas XII
                                    </option>
                                </select>
                                @error('kelas')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    id="alamat" name="alamat" value="{{ old('alamat', $anggota->alamat) }}"
                                    placeholder="Masukkan alamat lengkap" required>
                                @error('alamat')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_hp" class="form-label">No HP <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                    id="no_hp" name="no_hp" value="{{ old('no_hp', $anggota->no_hp) }}"
                                    placeholder="Contoh: 08123456789" required>
                                @error('no_hp')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon-check"></i> Simpan
                                </button>
                                <a href="{{ route('anggota.index') }}" class="btn btn-secondary">
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
