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
        Schema::create('bet_results', function (Blueprint $table) {
            $table->id();
            $table->string('win_color');
            $table->double('win_round');
            $table->double('win_amount');
            $table->double('win_users');
            $table->double('lost_users');
            $table->double('tot_users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bet_results');
    }
};
