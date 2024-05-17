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
        Schema::create('image_has_tags', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('image_id');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('image_id')->references('id')->on('image')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_has_tags');
    }
};
