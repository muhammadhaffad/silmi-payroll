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
        Schema::connection('mysql_tailor')->create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->boolean('is_active')->default(true);
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
        Schema::connection('mysql_tailor')->dropIfExists('employees');
        Schema::connection('mysql_tailor')->enableForeignKeyConstraints();
    }
};
