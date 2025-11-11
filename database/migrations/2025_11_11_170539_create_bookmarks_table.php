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
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id('bookmarkID');
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('listingID');
            $table->timestamp('bookmarkedDate')->useCurrent();
            $table->timestamps();

            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
            $table->foreign('listingID')->references('listingID')->on('listings')->onDelete('cascade');
            $table->unique(['userID', 'listingID'], 'unique_user_listing_bookmark');
            $table->index(['userID', 'bookmarkedDate']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
    }
};
