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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id('feedbackID');
            $table->enum('feedbackType', ['Suggestion', 'Complaint', 'Bug']);
            $table->string('feedbackText', 255);
            $table->timestamp('timeStamp')->useCurrent();
            $table->unsignedBigInteger('userID');
            $table->string('subject', 100);
            $table->enum('priority', ['High', 'Medium', 'Low'])->default('Medium');
            $table->enum('status', ['In Review', 'Resolved', 'Closed'])->default('In Review');
            $table->timestamps();

            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
