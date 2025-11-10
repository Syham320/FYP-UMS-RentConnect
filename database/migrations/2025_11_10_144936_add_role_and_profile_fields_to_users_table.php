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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'userName');
            $table->renameColumn('email', 'userEmail');
            $table->enum('userRole', ['Student', 'Landlord', 'Admin'])->default('Student');
            $table->string('contactInfo', 50)->nullable();
            $table->string('profileImg', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['userRole', 'contactInfo', 'profileImg']);
            $table->renameColumn('userName', 'name');
            $table->renameColumn('userEmail', 'email');
        });
    }
};
