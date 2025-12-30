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
        Schema::table('rental_requests', function (Blueprint $table) {
            $table->dropForeign('rental_requests_listingid_foreign');
            $table->dropForeign('rental_requests_studentid_foreign');
            $table->dropUnique(['listingID', 'studentID']);
            $table->foreign('listingID')->references('listingID')->on('listings')->onDelete('cascade');
            $table->foreign('studentID')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rental_requests', function (Blueprint $table) {
            $table->dropForeign('rental_requests_listingid_foreign');
            $table->dropForeign('rental_requests_studentid_foreign');
            $table->unique(['listingID', 'studentID']);
            $table->foreign('listingID')->references('listingID')->on('listings')->onDelete('cascade');
            $table->foreign('studentID')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
