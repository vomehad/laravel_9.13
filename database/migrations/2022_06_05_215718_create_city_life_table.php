<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityLifeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('city_life')) {
            Schema::create('city_life', function (Blueprint $table) {
                $table->id();
                $table->foreignId('city_id')->nullable()->constrained('cities')->cascadeOnUpdate()->nullOnDelete();
                $table->foreignId('life_id')->nullable()->constrained('life')->cascadeOnUpdate()->nullOnDelete();
                $table->string('start_date');
                $table->string('end_date')->nullable();
                $table->timestamps();
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
        Schema::dropIfExists('city_life');
    }
}
