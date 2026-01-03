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
        Schema::create('facility_signatories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->tinyIncrements('id');
            $table->unsignedInteger('accountant_id');
            $table->foreign('accountant_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('cashier_id');
            $table->foreign('cashier_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedTinyInteger('facility_id');
            $table->foreign('facility_id')->references('id')->on('facilities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_signatories');
    }
};
