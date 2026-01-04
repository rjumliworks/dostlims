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
        Schema::create('customers', function (Blueprint $table) {
            $table->engine = 'InnoDB'; 
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->boolean('is_main')->default(1);
            $table->boolean('is_internal')->default(0);
            $table->boolean('is_new')->default(1)->nullable();
            $table->boolean('is_active')->default(1);
            $table->unsignedTinyInteger('sex_id')->nullable();
            $table->foreign('sex_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->unsignedTinyInteger('led_id')->nullable();
            $table->foreign('led_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->unsignedTinyInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->unsignedTinyInteger('industry_id');
            $table->foreign('industry_id')->references('id')->on('list_industries')->onDelete('cascade');
            $table->unsignedTinyInteger('classification_id');
            $table->foreign('classification_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->unsignedBigInteger('name_id');
            $table->foreign('name_id')->references('id')->on('customer_names')->onDelete('cascade');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['name', 'name_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
