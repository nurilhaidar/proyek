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
        Schema::table('detail_peminjaman', function (Blueprint $table) {
            $table->foreign('id_barang')->references('id')->on('barang');
            $table->foreign('id_peminjaman')->references('id')->on('peminjaman');
        });

        Schema::table('status', function (Blueprint $table) {
            $table->foreign('id_peminjaman')->references('id')->on('peminjaman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
};
