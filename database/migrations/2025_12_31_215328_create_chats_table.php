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
        Schema::create('chats', function (Blueprint $table) {
            $table->id('chatID');
            $table->enum('requestStatus', ['pending', 'accepted', 'declined'])->default('pending');
            $table->timestamp('createdDate')->useCurrent();
            $table->unsignedBigInteger('landlordID');
            $table->unsignedBigInteger('studentID');
            $table->timestamps();

            $table->foreign('landlordID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('studentID')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['landlordID', 'studentID']); // Prevent duplicate chat requests
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
