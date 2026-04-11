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
    public function index()
    {
        $peminjaman = Peminjaman::with(['anggota', 'buku'])->get();

        return view('peminjaman/index')->with(['peminjaman' => $peminjaman]);
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
        Peminjaman::create([
            'id_anggota' => $request->id_anggota,
            'id_buku' => $request->id_buku,
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'Dipinjam',
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $buku = Buku::all();
        $anggota = Anggota::all();
        $data = Peminjaman::where('id_peminjaman', $id)->first();

        return view('peminjaman/edit')->with(['peminjaman' => $data , 'buku' => $buku , 'anggota' => $anggota]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id){
        Peminjaman::where('id_peminjaman', $id)
        ->update([
            'id_buku' => $request->id_buku,
            'id_anggota' => $request->id_anggota,
            'tanggal_pinjam' => $request->tanggal_kembali,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => $request->status,
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Data berhasil diubah!');
    }

    public function kembali(Request $request, string $id)
    {
        $data = Peminjaman::where('id_peminjaman', $id)->first();

        if($data->tanggal_kembali < date('Y-m-d')){
            $status = 'Kembali Terlambat';
        }else{
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
