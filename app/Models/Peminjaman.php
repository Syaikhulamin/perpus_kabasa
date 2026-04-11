<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = ['id_buku', 'id_anggota', 'tanggal_pinjam' , 'tanggal_kembali' , 'status'];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class , 'id_anggota' , 'id_anggota');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class , 'id_buku' , 'id_buku');
    }
}
