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
        Schema::create('expertise_allowances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_nip')->nullable();
            $table->foreign('employee_nip')->references('nip')->on('employees')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('nama');
            $table->unsignedInteger('jumlah');
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
        Schema::dropIfExists('expertise_allowances');
        Schema::disableForeignKeyConstraints();
    }
};
