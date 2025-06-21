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
        Schema::create('website_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained('website')->onDelete('cascade');
            $table->string('status');
            $table->text('error_details')->nullable();
            $table->timestamp('logged_at');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_logs');
    }
};
