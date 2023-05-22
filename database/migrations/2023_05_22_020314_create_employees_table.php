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
        Schema::enableForeignKeyConstraints();
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nip')->unique();
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->string('devisi');
            $table->string('jabatan');
            $table->date('tanggal_masuk');
            $table->text('alamat');
            $table->boolean('is_khusus');
            $table->boolean('status');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::disableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::enableForeignKeyConstraints();
        Schema::dropIfExists('employees');
        Schema::disableForeignKeyConstraints();
    }
};
