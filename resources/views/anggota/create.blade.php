@extends('layout')

@section('menu-anggota-active', 'active')
@section('content')
    <h1>Tambah anggota</h1>
    <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Kembali</a>
    <br><br>
    <form action="{{ route('anggota.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
         <div class="form-group">
            <label for="kelas">Kelas</label>
            <select name="kelas" id="kelas" class="form-control">
                <option value="Kelas X">Kelas X</option>
                <option value="Kelas XI">Kelas XI</option>
                <option value="Kelas XII">Kelas XII</option>
            </select>
        </div>
         <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" required>
        </div>
         <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="number" class="form-control" id="no_hp" name="no_hp" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection