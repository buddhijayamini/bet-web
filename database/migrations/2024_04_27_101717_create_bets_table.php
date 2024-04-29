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
        Schema::create('bets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('users_id');
            $table->double('round');
            $table->double('win_round')->nullable();
            $table->double('win_amount')->nullable();
            $table->double('win_users')->nullable();
            $table->double('tot_users')->nullable();
            $table->time('time_per_round');
            $table->date('date');
            $table->string('status', 45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bets');
    }
};
