<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLifeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('life')) {
            Schema::create('life', function (Blueprint $table) {
                $table->id();
                $table->foreignId('kinsman_id')
                    ->unique()
                    ->constrained('kinsmans')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
//                $table->timestamp('birth_date');
                $table->string('birth_date');
//                $table->timestamp('end_date')->nullable()->default(null);
                $table->string('end_date')->nullable()->default(null);
                $table->timestamps();
                $table->boolean('active')->default(true);
                $table->softDeletes();
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
        Schema::dropIfExists('life');
    }
}
