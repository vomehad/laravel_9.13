<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorColumnToKins extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('table', 'color')) {
            Schema::table('kins', function (Blueprint $table) {
                $table->tinyText('color')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kins', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
}
