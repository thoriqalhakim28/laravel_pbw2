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
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('transactionId');
            $table->unsignedbigInteger('collectionId');
            $table->foreign('transactionId')->references('id')->on('transactions');
            $table->foreign('collectionId')->references('id')->on('collections');
            $table->date('tanggalKembali')->nullable();
            $table->tinyInteger('status');
            $table->string('keterangan');
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
        Schema::dropIfExists('detail_transactions');
    }
};
