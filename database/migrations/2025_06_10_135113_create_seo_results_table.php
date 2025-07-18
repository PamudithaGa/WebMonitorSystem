<?php

// database/migrations/xxxx_xx_xx_create_seo_results_table.php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration {
//     public function up(): void
//     {
//         Schema::create('seo_results', function (Blueprint $table) {
//             $table->id();
//             $table->foreignId('website_id')->constrained()->onDelete('cascade');
//             $table->integer('score');
//             $table->json('issues')->nullable();           // array of issues with severity and page
//             $table->json('recommendations')->nullable();  // key-value format
//             $table->timestamp('checked_at');
//             $table->timestamps();

//             $table->foreign('website_id')->references('id')->on('website')->onDelete('cascade');
//         });
//     }

//     public function down(): void
//     {
//         Schema::dropIfExists('seo_results');
//     }
// };



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('seo_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')
                  ->constrained('website') 
                  ->onDelete('cascade');  
            $table->integer('score');
            $table->json('issues')->nullable(); 
            $table->json('recommendations')->nullable();
            $table->timestamp('checked_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_results');
    }
};
