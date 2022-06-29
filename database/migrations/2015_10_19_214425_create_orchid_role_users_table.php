<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrchidRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('role_users')) {
            Schema::create('role_users', function (Blueprint $table) {
                $table->primary(['user_id', 'role_id']);
                $table->foreignId('user_id')
                    ->constrained('users')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->foreignId('role_id')
                    ->constrained('roles')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('role_users');
    }
}
