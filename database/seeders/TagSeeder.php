<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
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
} 