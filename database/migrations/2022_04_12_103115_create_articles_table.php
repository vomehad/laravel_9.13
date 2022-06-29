<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('articles')) {
            Schema::create('articles', function (Blueprint $table) {
                $table->id();
                $table->tinyText('title');
                $table->string('preview');
                $table->text('text');

                $table->fullText('text');
                $table->tinyText('link');

                $table->foreignId('created_by')
                    ->nullable(false)
                    ->constrained('users')
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();

                $table->index(['created_by', 'created_at', 'updated_at']);
                $table->string('disk');
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
        Schema::dropIfExists('articles');
    }
}
