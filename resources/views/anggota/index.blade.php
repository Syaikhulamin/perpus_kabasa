@extends('layout')

@section('menu-anggota-active', 'active')
@section('content')
    <h1>Anggota Perpustakaan</h1>

    <a href="{{ route('anggota.create') }}" class="btn btn-primary">Tambah Anggota</a>
    <br><br>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($anggotas as $index => $anggota)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $anggota['nama'] }}</td>
                    <td>{{ $anggota['kelas'] }}</td>
                    <td>{{ $anggota['alamat'] }}</td>
                    <td>{{ $anggota['no_hp'] }}</td>
                    <td>
                        <a href="{{ route('anggota.edit', $anggota['id_anggota']) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('anggota.destroy', $anggota['id_anggota']) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $anggota['id_anggota'] }}">
                            <button class="btn btn-sm btn-danger" 
                            onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
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
