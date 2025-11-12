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
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('listingID');
                $table->timestamp('bookmarkedDate')->useCurrent();
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('listingID')->references('listingID')->on('listings')->onDelete('cascade');

                $table->unique(['user_id', 'listingID'], 'unique_user_listing_bookmark');
                $table->index(['user_id', 'bookmarkedDate']);
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
