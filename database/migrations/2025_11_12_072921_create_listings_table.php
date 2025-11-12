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
        Schema::create('listings', function (Blueprint $table) {
            $table->id('listingID');
            $table->string('listingTitle', 255);
            $table->text('listingDescription');
            $table->decimal('price', 10, 2);
            $table->string('location', 255);
            $table->string('contactInfo', 50)->nullable();
            $table->string('roomType', 50);
            $table->enum('availabilityStatus', ['approved', 'pending', 'rejected'])->default('pending');
            $table->timestamp('createdDate')->useCurrent();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['availabilityStatus', 'createdDate']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
