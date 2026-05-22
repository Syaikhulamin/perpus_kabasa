<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalBuku = Buku::count();
        $totalAnggota = Anggota::count();
        $totalPeminjaman = Peminjaman::count();
        $peminjamanAktif = Peminjaman::where('status', 'Dipinjam')->count();
        $peminjamanTerlambat = Peminjaman::where('status', 'Kembali Terlambat')->count();

        // Data peminjaman terbaru
        $peminjamanTerbaru = Peminjaman::with(['anggota', 'buku'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('index', [
            'totalBuku' => $totalBuku,
            'totalAnggota' => $totalAnggota,
            'totalPeminjaman' => $totalPeminjaman,
            'peminjamanAktif' => $peminjamanAktif,
            'peminjamanTerlambat' => $peminjamanTerlambat,
            'peminjamanTerbaru' => $peminjamanTerbaru,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
