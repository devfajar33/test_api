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
        Schema::create('api_detail_models', function (Blueprint $table) {
            $table->string('id', 30)->primary();
            $table->string('parent_id', 30);
            $table->string('label', 200);
            $table->string('type', 20)->nullable();   
            $table->string('sub_type', 10)->nullable();
            $table->string('orm_only', 5)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_detail_models');
    }
};
