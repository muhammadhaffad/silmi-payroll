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
        Schema::table('overtimes', function (Blueprint $table) {
            $table->after('nama', function (Blueprint $table) {
                $table->double('perjam')->default(0);
                $table->double('total_jam')->default(0);
            });
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
        Schema::table('overtimes', function (Blueprint $table) {
            $table->dropColumn('perjam');
            $table->dropColumn('total_jam');
        });
        Schema::enableForeignKeyConstraints();
    }
};
