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
        Schema::table('projects', function (Blueprint $table) {
            // Удаляем старые колонки
            $table->dropColumn([
                'trailerUrl',
                'trailer',
                'trailer2',
                'trailer3',
                '1episode',
                '2episode',
                '3episode',
                '4episode',
                '5episode',
                'episodes'
            ]);

            // Добавляем новые колонки
            $table->json('trailers')->nullable();
            $table->json('episodes')->nullable();
            $table->integer('episodes_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Удаляем новые колонки
            $table->dropColumn(['trailers', 'episodes', 'episodes_count']);

            // Возвращаем старые колонки
            $table->string('trailerUrl')->nullable();
            $table->string('trailer')->nullable();
            $table->string('trailer2')->nullable();
            $table->string('trailer3')->nullable();
            $table->string('1episode')->nullable();
            $table->string('2episode')->nullable();
            $table->string('3episode')->nullable();
            $table->string('4episode')->nullable();
            $table->string('5episode')->nullable();
            $table->string('episodes')->nullable();
        });
    }
};
