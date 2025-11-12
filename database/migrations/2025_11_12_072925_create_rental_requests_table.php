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
            $table->unsignedBigInteger('listingID');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('landlord_id');
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'accepted', 'declined', 'cancelled'])->default('pending');
            $table->timestamp('requestDate')->useCurrent();
            $table->timestamp('responseDate')->nullable();
            $table->timestamps();

            $table->foreign('listingID')->references('listingID')->on('listings')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('landlord_id')->references('id')->on('users')->onDelete('cascade');

            $table->index(['status', 'requestDate']);
            $table->unique(['listingID', 'student_id'], 'unique_listing_student_request');
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
