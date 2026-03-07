@extends('layout')

@section('menu-buku-active', 'active')
@section('content')
    <h1>Edit Buku</h1>
    <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
    <br><br>
    <form action="{{ route('buku.update', $buku->id_buku) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul}}" required>
        </div>
        <div class="form-group">
            <label for="pengarang">Pengarang</label>
            <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ $buku->pengarang}}" required>
        </div>
        <div class="form-group">
            <label for="penerbit">Penerbit</label>
            <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $buku->penerbit}}" required>
        </div>
        <div class="form-group">
            <label for="stok">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" value="{{ $buku->stok}}" required>
        </div>
        <div class="form-group">
            <label for="tahun_terbit">Tahun Terbit</label>
            <input type="date" class="form-control" id="tahun_terbit" name="tahun_terbit" 
            value="{{ \Carbon\Carbon::parse($buku->tahun_terbit)->format('Y-m-d') }}" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection