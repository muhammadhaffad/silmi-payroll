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
        Schema::connection('mysql_tailor')->disableForeignKeyConstraints();
        Schema::connection('mysql_tailor')->create('sewing_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('sewing_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->integer('qty')->default(0);
            $table->bigInteger('total')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::connection('mysql_tailor')->enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql_tailor')->disableForeignKeyConstraints();
        Schema::connection('mysql_tailor')->dropIfExists('sewing_tasks');
        Schema::connection('mysql_tailor')->enableForeignKeyConstraints();
    }
};
