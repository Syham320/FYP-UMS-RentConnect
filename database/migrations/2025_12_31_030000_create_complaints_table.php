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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id('complaintID');
            $table->enum('complaintCategory', ['Safety', 'Fraud', 'Facilities']);
            $table->string('complaintDescription', 255);
            $table->string('complaintFile', 255)->nullable();
            $table->enum('complaintStatus', ['pending', 'In review', 'Resolved'])->default('pending');
            $table->timestamp('submittedDate')->useCurrent();
            $table->unsignedBigInteger('userID');
            $table->timestamps();

            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
