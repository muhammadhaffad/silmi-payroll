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
        Schema::connection('mysql_tailor')->create('sewing_defect_rules', function (Blueprint $table) {
            $table->id();
            $table->integer('min_cacat_persen')->default(0);
            $table->integer('maks_cacat_persen')->default(0);
            $table->integer('kompensasi_persen')->default(0);
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
        Schema::connection('mysql_tailor')->dropIfExists('sewing_defect_rules');
    }
};
