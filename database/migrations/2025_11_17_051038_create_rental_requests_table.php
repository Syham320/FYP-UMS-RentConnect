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
        Schema::create('rental_requests', function (Blueprint $table) {
            $table->id('requestID');
            $table->enum('requestStatus', ['pending', 'accepted', 'declined'])->default('pending');
            $table->timestamp('requestDate')->useCurrent();
            $table->unsignedBigInteger('listingID');
            $table->unsignedBigInteger('studentID');
            $table->timestamps();

            $table->foreign('listingID')->references('listingID')->on('listings')->onDelete('cascade');
            $table->foreign('studentID')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['listingID', 'studentID']); // Prevent duplicate requests for same listing by same student
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_requests');
    }
};
