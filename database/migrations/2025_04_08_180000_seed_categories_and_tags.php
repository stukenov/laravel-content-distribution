<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Добавляем категории
        $categories = [
            'Фильмы',
            'Сериалы',
            'Мультфильмы',
            'Аниме',
            'Документальные',
            'ТВ-шоу',
            'Другое'
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'slug' => Str::slug($category),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Добавляем теги
        $tags = [
            'Боевик',
            'Комедия',
            'Драма',
            'Триллер',
            'Ужасы',
            'Фантастика',
            'Фэнтези',
            'Детектив',
            'Приключения',
            'Мелодрама',
            'Криминал',
            'Вестерн',
            'Биография',
            'Исторический',
            'Военный',
            'Спорт',
            'Семейный',
            'Мюзикл',
            'Короткометражка',
            'Документальный'
        ];

        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'name' => $tag,
                'slug' => Str::slug($tag),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('categories')->whereIn('name', [
            'Фильмы',
            'Сериалы',
            'Мультфильмы',
            'Аниме',
            'Документальные',
            'ТВ-шоу',
            'Другое'
        ])->delete();

        DB::table('tags')->whereIn('name', [
            'Боевик',
            'Комедия',
            'Драма',
            'Триллер',
            'Ужасы',
            'Фантастика',
            'Фэнтези',
            'Детектив',
            'Приключения',
            'Мелодрама',
            'Криминал',
            'Вестерн',
            'Биография',
            'Исторический',
            'Военный',
            'Спорт',
            'Семейный',
            'Мюзикл',
            'Короткометражка',
            'Документальный'
        ])->delete();
    }
}; 