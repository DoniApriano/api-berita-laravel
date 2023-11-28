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
        Schema::create('report_responds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comment_report_id');
            $table->unsignedBigInteger('reporter_user_id');
            $table->unsignedBigInteger('reported_user_id');
            $table->unsignedBigInteger('comment_id');
            $table->string('description');
            $table->string('msg_for_reporter');
            $table->string('msg_for_reported');
            $table->timestamps();

            $table->foreign('comment_report_id')->references('id')->on('comment_reports');
            $table->foreign('reporter_user_id')->references('id')->on('users');
            $table->foreign('reported_user_id')->references('id')->on('users');
            $table->foreign('comment_id')->references('id')->on('comments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_responds');
    }
};
