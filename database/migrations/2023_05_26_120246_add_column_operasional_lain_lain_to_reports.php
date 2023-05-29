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
        Schema::table('reports', function (Blueprint $table) {
            $table->after('tunjangan_masa_kerja', function (Blueprint $table) {
                $table->bigInteger('tunjangan_operasional')->default(0);
                $table->bigInteger('tunjangan_lain_lain')->default(0);
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('tunjangan_operasional');
            $table->dropColumn('tunjangan_lain_lain');
        });
    }
};
