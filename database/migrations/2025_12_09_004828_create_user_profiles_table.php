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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('lastname',150)->index();
            $table->text('firstname');
            $table->text('middlename');
            $table->text('mobile');
            $table->string('mobile_hash', 64)->unique()->index();
            $table->string('avatar', 200)->default('noavatar.jpg');
            $table->string('signature', 200)->default('nosig.jpg');
            $table->unsignedSmallInteger('suffix_id')->nullable(); 
            $table->foreign('suffix_id')->references('id')->on('list_data')->restrictOnDelete();
            $table->unsignedSmallInteger('sex_id'); 
            $table->foreign('sex_id')->references('id')->on('list_data')->restrictOnDelete();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
