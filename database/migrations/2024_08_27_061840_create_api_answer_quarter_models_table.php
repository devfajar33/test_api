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
        Schema::create('api_answer_quarter_models', function (Blueprint $table) {
            $table->string('id', 30)->primary();
            $table->string('value', 40)->nullable();
            $table->string('parent_id', 30);
            $table->string('label', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_answer_quarter_models');
    }
};
