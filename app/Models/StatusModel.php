<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusModel extends Model
{
    use HasFactory;

    protected $table = 'status';
    protected $fillable = [
        'id_peminjaman',
        'tgl',
        'status',
        'keterangan',
    ];

    public function status()
    {
        $this->belongsTo(PeminjamanModel::class, 'id_peminjaman', 'id');
    }
}
