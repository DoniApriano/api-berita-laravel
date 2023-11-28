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
        Schema::create('submission_responds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('submission_request_id');
            $table->unsignedBigInteger('user_id');
            $table->text('text');
            $table->datetimes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('submission_request_id')->references('id')->on('submission_requests');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submission_responds');
    }
};
