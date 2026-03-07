<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Anggota::orderby('created_at', 'desc')->get();

        return view('anggota/index')->with(['anggotas' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anggota/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = new Anggota;
        $data->nama = $request->nama;
        $data->kelas = $request->kelas;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->save();

        return redirect()->route('anggota.index')->with('success', 'Data berhasil ditambahkan!');
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
        $data = Anggota::where('id_anggota', $id)->first();

        return view('anggota/edit')->with(['anggota' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Anggota::where('id_anggota', $id)
        ->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Anggota::where('id_anggota', $id);
        $data->delete();

        return redirect()->route('anggota.index')->with('success', 'Data berhasil dihapus!');
    }
}
