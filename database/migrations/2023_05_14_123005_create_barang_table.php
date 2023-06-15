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
        Schema::create('barang', function (Blueprint $table) {
            $table->varchar('id', 50)->primary();
            $table->string('nama', 50)->nullable();
            $table->string('no_inventaris', 30)->nullable();
            $table->string('sumber_dana', 50)->nullable();
            $table->integer('jumlah_awal')->nullable();
            $table->string('status', 50)->nullable();
            $table->integer('stok')->nullable();
            $table->string('kondisi', 50)->nullable();
            $table->string('satuan', 50)->nullable();
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
        Schema::dropIfExists('barang');
    }
};
