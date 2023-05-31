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
        Schema::connection('mysql_tailor')->create('reports', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nama');
            $table->json('rincian_jahit');
            $table->bigInteger('total_jahit')->default(0);
            $table->integer('kompensasi_persen')->default(0);
            $table->bigInteger('kompensasi')->default(0);
            $table->bigInteger('total_gaji_after_kompensasi')->default(0);
            $table->json('rincian_kebutuhan_jahit');
            $table->bigInteger('total_kebutuhan')->default(0);
            $table->bigInteger('total_gaji_after_kebutuhan')->default(0);
            $table->integer('cacat_persen')->default(0);
            $table->integer('kompensasi_cacat_persen')->default(0);
            $table->bigInteger('kompensasi_cacat')->default(0);
            $table->bigInteger('cicilan')->default(0);
            $table->bigInteger('bubut')->default(0);
            $table->bigInteger('gaji_final')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_tailor')->dropIfExists('reports');
    }
};
