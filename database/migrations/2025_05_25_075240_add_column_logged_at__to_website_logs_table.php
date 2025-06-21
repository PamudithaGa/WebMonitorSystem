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
        Schema::table('website_logs', function (Blueprint $table) {
            if (!Schema::hasColumn('website_logs', 'logged_at')) {
                $table->timestamp('logged_at')->nullable()->after('error_details');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('website_logs', function (Blueprint $table) {
            if (Schema::hasColumn('website_logs', 'logged_at')) {
                $table->dropColumn('logged_at');
            }
        });
    }
};
