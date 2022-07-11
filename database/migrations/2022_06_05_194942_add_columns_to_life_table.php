<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToLifeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('life', 'city_id')) {
            Schema::table('life', function (Blueprint $table) {
                $table->foreignId('city_id')
                    ->nullable()
                    ->constrained('cities')
                    ->cascadeOnUpdate()->nullOnDelete();
                $table->foreignId('native_city_id')
                    ->nullable()
                    ->constrained('cities')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
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
        Schema::table('life', function (Blueprint $table) {
            $table->dropForeign('city_id');
//            $table->dropColumn('city_id');
            $table->dropForeign('native_city_id');
//            $table->dropColumn('native_city_id');
        });
    }
}
