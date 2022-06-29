<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignToKinsmans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('kinsmans', 'life_id')) {
            Schema::table('kinsmans', function (Blueprint $table) {
                $table->foreignId('life_id')
                    ->nullable()
                    ->constrained('kinsmans')
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
        Schema::table('kinsmans', function (Blueprint $table) {
            $table->dropForeign('kinsmans_life_id_foreign');
            $table->dropColumn('life_id');
        });
    }
}
