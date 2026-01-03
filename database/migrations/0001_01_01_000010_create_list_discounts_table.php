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
        Schema::create('list_discounts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->tinyIncrements('id');
            $table->string('name')->unique();
            $table->string('value');
            $table->dateTime('from')->nullable();
            $table->dateTime('to')->nullable();
            $table->unsignedTinyInteger('based_id');
            $table->foreign('based_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->unsignedTinyInteger('type_id');
            $table->foreign('type_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->unsignedTinyInteger('subtype_id');
            $table->foreign('subtype_id')->references('id')->on('list_dropdowns')->onDelete('cascade');
            $table->boolean('is_active')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_discounts');
    }
};
