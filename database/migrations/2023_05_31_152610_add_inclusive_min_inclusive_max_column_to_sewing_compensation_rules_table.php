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
        Schema::connection('mysql_tailor')->table('sewing_compensation_rules', function (Blueprint $table) {
            $table->after('maks_total_jahit', function (Blueprint $table) {
                $table->boolean('inclusive_min')->default(true);
                $table->boolean('inclusive_maks')->default(true);
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
        Schema::connection('mysql_tailor')->table('sewing_compensation_rules', function (Blueprint $table) {
            $table->dropColumn('inclusive_min');
            $table->dropColumn('inclusive_maks');
        });
    }
};
