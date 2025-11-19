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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id('faqID');
            $table->string('faqQuestion', 255);
            $table->text('faqAnswer');
            $table->enum('user_role', ['Student', 'Landlord']);
            $table->string('category', 100);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('adminID');
            $table->timestamp('updatedDate')->useCurrent();
            $table->timestamps();

            $table->foreign('adminID')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
