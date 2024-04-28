<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bet_users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id');
            $table->string('color');
            $table->double('amount');
            $table->string('win_color');
            $table->double('win_amount');
            $table->string('status', 45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bet_users');
    }
};
