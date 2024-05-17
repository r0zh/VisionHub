<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('image', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('style_id');
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->string('path');
            $table->bigInteger('seed');
            $table->text('positivePrompt');
            $table->text('negativePrompt')->nullable();
            $table->boolean('public');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('style_id')->references('id')->on('styles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image');
    }
};
