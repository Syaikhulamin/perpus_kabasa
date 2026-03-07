@extends('layout')

@section('menu-anggota-active', 'active')
@section('content')
    <h1>Edit Anggota</h1>
    <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Kembali</a>
    <br><br>
    <form action="{{ route('anggota.update', $anggota->id_anggota) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $anggota->nama}}" required>
        </div>
        <div class="form-group">
            <label for="kelas">Kelas</label>

            <select name="kelas" id="kelas" class="form-control">
                <option value="Kelas X" @if ($anggota->kelas == "Kelas X") selected @endif>Kelas X</option>
                <option value="Kelas XI" @if ($anggota->kelas == "Kelas XI") selected @endif>Kelas XI</option>
                <option value="Kelas XII" @if ($anggota->kelas == "Kelas XII") selected @endif>Kelas XII</option>
            </select>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $anggota->alamat}}" required>
        </div>
        <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ $anggota->no_hp}}" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection