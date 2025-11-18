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
        Schema::create('accommodation_forms', function (Blueprint $table) {
            $table->id('registrationID');
            $table->string('address', 255);
            $table->string('landlordName', 255);
            $table->enum('rentalType', ['Single Room', 'Shared Room', 'Studio']);
            $table->string('rentalAgreement', 255)->nullable();
            $table->string('paymentProof', 255)->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamp('submittedDate')->useCurrent();
            $table->unsignedBigInteger('studentID');
            $table->foreign('studentID')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodation_forms');
    }
};
