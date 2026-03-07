<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Buku::orderby('created_at', 'desc')->get(); 

        // die dump 
        // dd($data);

        // dd($data , empty($data));

        return view('buku/index')->with(['bukus' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = new Buku;
        $data->judul = $request->judul;
        $data->pengarang = $request->pengarang;
        $data->penerbit = $request->penerbit;
        $data->stok = 0;
        $data->tahun_terbit = $request->tahun_terbit;
        $data->save();

        return redirect()->route('buku.index')->with('success', 'Data berhasil ditambahkan!');
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
        $data = Buku::where('id_buku', $id)->first();

        return view('buku/edit')->with(['buku' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Buku::where('id_buku', $id)
        ->update([
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'stok' => $request->stok,
        ]);

        return redirect()->route('buku.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Buku::where('id_buku', $id);
        $data->delete();

        return redirect()->route('buku.index')->with('success', 'Data berhasil dihapus!');
    }
}
