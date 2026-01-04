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
        Schema::create('configurations', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('code',10)->unique();
            $table->string('name')->unique();
            $table->json('form');
            $table->json('contact');
            $table->boolean('samplecode_year');
            $table->boolean('show_others');
            $table->boolean('strict_mode');
            $table->string('region_code')->nullable()->constrained();
            $table->foreign('region_code')->references('code')->on('location_regions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
