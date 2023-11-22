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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->enum('attempt',['5','10','15','20']);
            $table->enum('obstacle',['active','deactive']);
            $table->string('colorOne');
            $table->string('colorTwo');
            $table->string('background');
            $table->string('audio');
            $table->enum('audioPlay',['active','deactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
