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
        Schema::create('resource_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_type');
            $table->string('resource_name');
            $table->string('resource_url');
            $table->text('resource_description')->nullable();
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('resolved_by')->nullable();
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('users');
            $table->foreign('resolved_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_requests');
    }
};
