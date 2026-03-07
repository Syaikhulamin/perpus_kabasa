@extends('layout')

@section('menu-buku-active', 'active')
@section('content')
    <h1>Buku Perpustakaan</h1>

    <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Buku</a>
    <br><br>

    @include('alert')

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bukus as $index => $buku)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $buku['judul'] }}</td>
                    <td>{{ $buku['pengarang'] }}</td>
                    <td>{{ $buku['penerbit'] }}</td>
                    <td>{{ $buku['tahun_terbit'] }}</td>
                    <td>{{ $buku['stok'] }}</td>
                    <td>
                        <a href="{{ route('buku.edit', $buku['id_buku']) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('buku.destroy', $buku['id_buku']) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $buku['id_buku'] }}">
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
