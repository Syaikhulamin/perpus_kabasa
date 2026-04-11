@extends('layout')

@section('menu-buku-active', 'active')
@section('content')
    <h1>Edit Peminjaman</h1>
    <a href="{{ route('buku.index') }}" class="btn btn-secondary">Kembali</a>
    <br><br>
    <form action="{{ route('peminjaman.update', $peminjaman->id_peminjaman) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="Anggota">Anggota</label>
            <select name="id_anggota" class="form-control" required>
                <option value="">Pilih anggota</option>
                @foreach($anggota as $anggota)
                    <option value="{{ $anggota->id_anggota }}" @if($anggota->id_anggota == $peminjaman->id_anggota) selected @endif>{{ $anggota->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="Buku">Buku</label>
            <select name="id_buku" class="form-control" required>
                <option value="">Pilih buku</option>
                @foreach($buku as $buku)
                    <option value="{{ $buku->id_buku }}" @if($buku->id_buku == $peminjaman->id_buku) selected @endif>{{ $buku->judul }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="Anggota">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" required value="{{ $peminjaman->tanggal_pinjam }}">
        </div>
        <div class="form-group">
            <label for="Anggota">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control" required value="{{ $peminjaman->tanggal_kembali }}">
        </div>

        <div class="form-group">
            <label for="Status">Status</label>
            <select name="status" class="form-control" required>
                <option value="">Pilih status</option>
                <option value="Dipinjam" @if($peminjaman->status == 'Dipinjam') selected @endif>Dipinjam</option>
                <option value="Kembali" @if($peminjaman->status == 'Kembali') selected @endif>Kembali</option>
                <option value="Kembali Terlambat" @if($peminjaman->status == 'Kembali Terlambat') selected @endif>Kembali Terlambat</option>
            </select>
        </div>

        <div class="form-group">
        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection