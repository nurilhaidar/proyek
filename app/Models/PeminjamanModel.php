<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanModel extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $fillable = [
        'nama_peminjam',
        'asal_oki',
        'kode_barang',
        'nama_barang',
        'jumlah_barang',
        'tanggal_pinjam',
        'tanggal_kembali',
        'surat',
        'jaminan',
        'kondisi',
        'status'
    ];

    public function detail()
    {
        return $this->belongsToMany(BarangModel::class, 'detail_peminjaman', 'id_peminjaman', 'id_barang')->withPivot('qty');
    }

    public function status()
    {
        return $this->hasOne(StatusModel::class, 'id_peminjaman', 'id');
    }
}
