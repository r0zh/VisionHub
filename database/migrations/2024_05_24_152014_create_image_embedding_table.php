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
        Schema::create('image_embedding', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('embedding_id');
            $table->unsignedBigInteger('image_id');
            $table->float('weight');
            $table->string('prompt_target');
            $table->foreign('embedding_id')->references('id')->on('embeddings')->onDelete('cascade');
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_embedding');
    }
};
