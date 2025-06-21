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
        // Schema::create('ssl_certificates', function (Blueprint $table) {
            // $table->id();
            // $table->foreignId('website_id')->constrained()->onDelete('cascade');
            // $table->date('expiry_date'); 
            // $table->boolean('alert_sent')->default(false);
            // $table->timestamps();
        // });
    }


    public function down(): void
    {
        // Schema::dropIfExists('ssl_certificates');
    }
};
