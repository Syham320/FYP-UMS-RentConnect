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
        Schema::table('accommodation_forms', function (Blueprint $table) {
            $table->unsignedBigInteger('rentalRequestID')->nullable()->after('studentID');
            $table->foreign('rentalRequestID')->references('requestID')->on('rental_requests')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accommodation_forms', function (Blueprint $table) {
            $table->dropForeign(['rentalRequestID']);
            $table->dropColumn('rentalRequestID');
        });
    }
};
