<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('seo_traffic', function (Blueprint $table) {
            $table->integer('location_code')->nullable()->after('website_id');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seo_traffic', function (Blueprint $table) {
            //
        });
    }
};
