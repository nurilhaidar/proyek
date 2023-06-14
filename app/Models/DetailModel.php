<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailModel extends Model
{
    use HasFactory;

    protected $table = 'detail_peminjaman';
    protected $fillable = [
        'id_peminjaman',
        'id_barang',
        'qty'
    ];
}
