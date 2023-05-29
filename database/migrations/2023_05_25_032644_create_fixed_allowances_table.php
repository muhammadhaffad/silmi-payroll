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
        Schema::create('fixed_allowances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_nip')->nullable();
            $table->foreign('employee_nip')->references('nip')->on('employees')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->bigInteger('keahlian')->default(0);
            $table->bigInteger('kepala_keluarga')->default(0);
            $table->bigInteger('masa_kerja')->default(0);
            $table->bigInteger('lembur')->default(0);
            $table->bigInteger('reward')->default(0);
            $table->bigInteger('infaq')->default(0);
            $table->bigInteger('cicilan')->default(0);
            $table->bigInteger('total')->default(0);
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
        Schema::dropIfExists('fixed_allowances');
    }
};
