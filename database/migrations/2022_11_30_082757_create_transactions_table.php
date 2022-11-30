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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userIdPetugas');
            $table->unsignedBigInteger('userIdPeminjam');
            $table->foreign('userIdPetugas')->references('id')->on('users');
            $table->foreign('userIdPeminjam')->references('id')->on('users');
            $table->date('tanggalPinjam');
            $table->date('tanggalSelesai')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
