@extends('layout')

@section('menu-peminjaman-active', 'active')
@section('content')
    <h1>Peminjaman Perpustakaan</h1>

    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">Tambah Peminjaman</a>
    <br><br>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjaman as $index => $peminjaman)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $peminjaman->anggota->nama }}</td>
                    <td>{{ $peminjaman->buku->judul }}</td>
                    <td>{{ $peminjaman->tanggal_pinjam }}</td>
                    <td>{{ $peminjaman->tanggal_kembali }}</td>
                    <td>{{ $peminjaman->status }}</td>
                    <td>

                        <form action="{{ route('peminjaman.destroy', $peminjaman['id_peminjaman']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $peminjaman['id_peminjaman'] }}">
                            <button class="btn btn-sm btn-info" 
                            onclick="return confirm('Yakin ingin menghapus data ini?')">Kembali</button>
                        </form>
                        <a href="{{ route('peminjaman.edit', $peminjaman['id_peminjaman']) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('peminjaman.destroy', $peminjaman['id_peminjaman']) }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $peminjaman['id_peminjaman'] }}">
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
