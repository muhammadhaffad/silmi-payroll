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
        Schema::disableForeignKeyConstraints();
        Schema::create('attendance_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_nip')->nullable();
            $table->foreign('employee_nip')->references('nip')->on('employees')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->date('tanggal');
            $table->date('tanggal_expired');
            $table->time('scan_1')->nullable();
            $table->time('scan_2')->nullable();
            $table->time('scan_3')->nullable();
            $table->time('scan_4')->nullable();
            $table->integer('jam');
            $table->integer('menit');
            $table->double('total_jam');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('attendance_logs');
        Schema::enableForeignKeyConstraints();
    }
};
