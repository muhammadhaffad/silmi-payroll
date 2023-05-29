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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('devisi');
            $table->integer('nip');
            $table->string('nama');
            $table->string('jabatan');
            $table->boolean('is_khusus');
            $table->bigInteger('gaji_pokok')->default(0);
            $table->bigInteger('tunjangan_jabatan')->default(0);
            $table->double('perjam')->default(0);
            $table->double('total_jam')->default(0);
            $table->bigInteger('total')->default(0);
            $table->json('rincian_keahlian')->default(0);
            $table->bigInteger('tunjangan_keahlian')->default(0);
            $table->bigInteger('tunjangan_kepala_keluarga')->default(0);
            $table->bigInteger('tunjangan_masa_kerja')->default(0);
            $table->bigInteger('lembur')->default(0);
            $table->bigInteger('reward')->default(0);
            $table->bigInteger('infaq')->default(0);
            $table->bigInteger('cicilan')->default(0);
            $table->bigInteger('take_home')->default(0);
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
        Schema::dropIfExists('reports');
    }
};
