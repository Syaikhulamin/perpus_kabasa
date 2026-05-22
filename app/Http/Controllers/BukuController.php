<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');

        if ($search) {
            $data = Buku::where('judul', 'like', '%' . $search . '%')
                ->orderby('created_at', 'desc')
                ->simplePaginate(5);
        } else {
            $data = Buku::orderby('created_at', 'desc')->simplePaginate(5);
        }

        return view('buku/index')->with(['books' => $data, 'search' => $search]);
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
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|date',
        ], [
            'judul.required' => 'Judul buku harus diisi',
            'judul.max' => 'Judul buku maksimal 255 karakter',
            'pengarang.required' => 'Pengarang harus diisi',
            'pengarang.max' => 'Pengarang maksimal 255 karakter',
            'penerbit.required' => 'Penerbit harus diisi',
            'penerbit.max' => 'Penerbit maksimal 255 karakter',
            'tahun_terbit.required' => 'Tahun terbit harus diisi',
            'tahun_terbit.date' => 'Format tahun terbit tidak valid',
        ]);

        $data = new Buku;
        $data->judul = $validated['judul'];
        $data->pengarang = $validated['pengarang'];
        $data->penerbit = $validated['penerbit'];
        $data->stok = 0;
        $data->tahun_terbit = $validated['tahun_terbit'];
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
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|date',
            'stok' => 'required|integer|min:0',
        ], [
            'judul.required' => 'Judul buku harus diisi',
            'judul.max' => 'Judul buku maksimal 255 karakter',
            'pengarang.required' => 'Pengarang harus diisi',
            'pengarang.max' => 'Pengarang maksimal 255 karakter',
            'penerbit.required' => 'Penerbit harus diisi',
            'penerbit.max' => 'Penerbit maksimal 255 karakter',
            'tahun_terbit.required' => 'Tahun terbit harus diisi',
            'tahun_terbit.date' => 'Format tahun terbit tidak valid',
            'stok.required' => 'Stok harus diisi',
            'stok.integer' => 'Stok harus berupa angka',
            'stok.min' => 'Stok minimal 0',
        ]);

        Buku::where('id_buku', $id)
            ->update($validated);

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
