<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $keyTupe = 'string';
    public $timestamps = false;
    protected $fillable = [
        'nama_barang',
        'stok',
        'kondisi',
        'satuan',
        'sumber_dana',
        'jumlah_awal',
        'status',
        'no_inventaris',
        'id'
    ];

    public function pinjam()
    {
        return $this->belongsToMany(PeminjamanModel::class, 'detail_peminjaman', 'id_barang', 'id_peminjaman')->withPivot('qty');
    }
}
