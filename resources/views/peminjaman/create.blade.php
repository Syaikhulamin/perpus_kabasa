@extends('layout')

@section('menu-buku-active', 'active')
@section('content')
    <h1>Tambah Peminjaman</h1>
    <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
    <br><br>
    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="Anggota">Anggota</label>
            <select name="id_anggota" class="form-control" required>
                <option value="">Pilih anggota</option>
                @foreach($anggota as $anggota)
                    <option value="{{ $anggota->id_anggota }}">{{ $anggota->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="Buku">Buku</label>
            <select name="id_buku" class="form-control" required>
                <option value="">Pilih buku</option>
                @foreach($buku as $buku)
                    <option value="{{ $buku->id_buku }}">{{ $buku->judul }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="Anggota">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection