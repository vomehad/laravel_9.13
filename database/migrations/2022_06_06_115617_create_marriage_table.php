<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarriageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('marriage')) {
            Schema::create('marriage', function (Blueprint $table) {
                $table->id();
                $table->foreignId('husband_id')
                    ->nullable()
                    ->constrained('kinsmans')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
                $table->foreignId('wife_id')
                    ->nullable()
                    ->constrained('kinsmans')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
                $table->string('wedding_date')->nullable();
                $table->string('divorce_date')->nullable();
                $table->boolean('active')->default(true);
                $table->timestamps();
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
        Schema::dropIfExists('marriage');
    }
}
