<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nama_peminjam', 50)->unique();
            $table->string('asal_oki', 50);
            $table->string('telp', 15);
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->string('surat', 10);
            $table->string('jaminan', 10);
            $table->unsignedBigInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
};
