<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;


class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        if ($search) {

            $peminjaman = Peminjaman::with(['anggota', 'buku'])
                ->whereHas('anggota', fn($q) => $q->where('nama', 'like', '%' . $search . '%'))
                ->orderBy('created_at', 'desc')
                ->simplePaginate(5);
        } else {
            $peminjaman = Peminjaman::with(['anggota', 'buku'])->orderBy('created_at', 'desc')->simplePaginate(5);
        }

        return view('peminjaman/index')->with(['peminjamans' => $peminjaman, 'search' => $search]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $buku = Buku::all();
        $anggota = Anggota::all();

        return view('peminjaman/create')->with(['buku' => $buku, 'anggota' => $anggota]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_anggota' => 'required|exists:anggotas,id_anggota',
            'id_buku' => 'required|exists:bukus,id_buku',
            'tanggal_kembali' => 'required|date|after_or_equal:today',
        ], [
            'id_anggota.required' => 'Anggota harus dipilih',
            'id_anggota.exists' => 'Anggota tidak ditemukan',
            'id_buku.required' => 'Buku harus dipilih',
            'id_buku.exists' => 'Buku tidak ditemukan',
            'tanggal_kembali.required' => 'Tanggal kembali harus diisi',
            'tanggal_kembali.date' => 'Format tanggal kembali tidak valid',
            'tanggal_kembali.after_or_equal' => 'Tanggal kembali tidak boleh kurang dari hari ini',
        ]);

        Peminjaman::create([
            'id_anggota' => $validated['id_anggota'],
            'id_buku' => $validated['id_buku'],
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'status' => 'Dipinjam',
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $buku = Buku::all();
        $anggota = Anggota::all();
        $data = Peminjaman::where('id_peminjaman', $id)->first();

        return view('peminjaman/edit')->with(['peminjaman' => $data, 'buku' => $buku, 'anggota' => $anggota]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'id_anggota' => 'required|exists:anggotas,id_anggota',
            'id_buku' => 'required|exists:bukus,id_buku',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:Dipinjam,Kembali,Kembali Terlambat',
        ], [
            'id_anggota.required' => 'Anggota harus dipilih',
            'id_anggota.exists' => 'Anggota tidak ditemukan',
            'id_buku.required' => 'Buku harus dipilih',
            'id_buku.exists' => 'Buku tidak ditemukan',
            'tanggal_pinjam.required' => 'Tanggal pinjam harus diisi',
            'tanggal_pinjam.date' => 'Format tanggal pinjam tidak valid',
            'tanggal_kembali.required' => 'Tanggal kembali harus diisi',
            'tanggal_kembali.date' => 'Format tanggal kembali tidak valid',
            'tanggal_kembali.after_or_equal' => 'Tanggal kembali harus lebih besar atau sama dengan tanggal pinjam',
            'status.required' => 'Status harus dipilih',
            'status.in' => 'Status tidak valid',
        ]);

        Peminjaman::where('id_peminjaman', $id)->update($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Data berhasil diubah!');
    }

    public function kembali(Request $request, string $id)
    {
        $data = Peminjaman::where('id_peminjaman', $id)->first();

        if ($data->tanggal_kembali < date('Y-m-d')) {
            $status = 'Kembali Terlambat';
        } else {
            $status = 'Kembali';
        }

        Peminjaman::where('id_peminjaman', $id)
            ->update([
                'status' => $status,
            ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Peminjaman::where('id_peminjaman', $id);
        $data->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data berhasil dihapus!');
    }
}
