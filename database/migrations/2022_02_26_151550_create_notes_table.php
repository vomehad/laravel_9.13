<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('notes')) {
            Schema::create('notes', function (Blueprint $table) {
                $table->id();
                $table->tinyText('name')->nullable(false);
                $table->text('content')->nullable(true);
                $table->foreignId('parent_id')
                    ->nullable()
                    ->constrained('notes')
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();
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
        Schema::dropIfExists('notes');
    }
}
