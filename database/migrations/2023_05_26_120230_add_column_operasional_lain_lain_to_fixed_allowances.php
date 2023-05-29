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
        Schema::table('fixed_allowances', function (Blueprint $table) {
            $table->after('masa_kerja', function (Blueprint $table) {
                $table->bigInteger('operasional')->default(0);
                $table->bigInteger('lain_lain')->default(0);
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
        Schema::table('fixed_allowances', function (Blueprint $table) {
            $table->dropColumn('operasional');
            $table->dropColumn('lain_lain');
        });
    }
};
