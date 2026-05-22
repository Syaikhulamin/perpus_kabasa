<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->get('search');

        if ($search) {
            $data = Anggota::where('nama', 'like', '%' . $search . '%')
                ->orderby('created_at', 'desc')
                ->simplePaginate(5);
        } else {
            $data = Anggota::orderby('created_at', 'desc')->simplePaginate(5);
        }

        return view('anggota/index')->with(['anggotas' => $data, 'search' => $search]);
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
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|in:Kelas X,Kelas XI,Kelas XII',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,13',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'kelas.required' => 'Kelas harus diisi',
            'kelas.in' => 'Pilih kelas yang valid',
            'alamat.required' => 'Alamat harus diisi',
            'alamat.max' => 'Alamat maksimal 255 karakter',
            'no_hp.required' => 'Nomor HP harus diisi',
            'no_hp.numeric' => 'Nomor HP harus berupa angka',
            'no_hp.digits_between' => 'Nomor HP harus 10-13 digit',
        ]);

        $data = new Anggota;
        $data->nama = $validated['nama'];
        $data->kelas = $validated['kelas'];
        $data->alamat = $validated['alamat'];
        $data->no_hp = $validated['no_hp'];
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
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|in:Kelas X,Kelas XI,Kelas XII',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,13',
        ], [
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'kelas.required' => 'Kelas harus diisi',
            'kelas.in' => 'Pilih kelas yang valid',
            'alamat.required' => 'Alamat harus diisi',
            'alamat.max' => 'Alamat maksimal 255 karakter',
            'no_hp.required' => 'Nomor HP harus diisi',
            'no_hp.numeric' => 'Nomor HP harus berupa angka',
            'no_hp.digits_between' => 'Nomor HP harus 10-13 digit',
        ]);

        Anggota::where('id_anggota', $id)->update($validated);

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
