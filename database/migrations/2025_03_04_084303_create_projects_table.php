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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->nullable();

            $table->string('author')->nullable();
            $table->string('time')->nullable();
            $table->string('slider_image')->nullable();

            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->string('trailerUrl')->nullable();
            $table->string('trailer')->nullable();
            $table->string('trailer2')->nullable();
            $table->string('trailer3')->nullable();
            $table->string('1episode')->nullable();
            $table->string('2episode')->nullable();
            $table->string('3episode')->nullable();
            $table->string('4episode')->nullable();
            $table->string('5episode')->nullable();
            $table->string('slider')->nullable();
            $table->integer('year')->nullable();
            $table->string('country')->nullable();
            $table->string('genre')->nullable();
            $table->string('quality')->nullable();
            $table->string('director')->nullable();
            $table->string('cast')->nullable();
            $table->string('episodes')->nullable();
            $table->string('subtitles')->nullable();
            $table->string('subtitles_lang')->nullable();
            $table->string('mande')->nullable();
            $table->string('mande_lang')->nullable();
            $table->string('update_cause')->nullable();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
