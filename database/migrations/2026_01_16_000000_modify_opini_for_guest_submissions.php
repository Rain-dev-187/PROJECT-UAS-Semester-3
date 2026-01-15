<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('opini', function (Blueprint $table) {
            // Make user_id nullable to allow guest submissions
            $table->foreignId('user_id')->nullable()->change();
            
            // Add email for guest submissions
            $table->string('penulis_email')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('opini', function (Blueprint $table) {
            // Revert to required user_id
            $table->foreignId('user_id')->nullable(false)->change();
            
            // Remove email column
            $table->dropColumn('penulis_email');
        });
    }
};
