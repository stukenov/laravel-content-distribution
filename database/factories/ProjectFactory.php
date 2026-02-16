<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projects>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
//            'email' => fake()->unique()->safeEmail(),
//            'email_verified_at',
//            'password' => static::$password ??= Hash::make('password'),
//            'remember_token' => Str::random(10),
            'time'=>now(),
            'title' => fake()->name(),
            'slug'=>fake()->name(),
            'description' =>fake()->name(),
            'content' =>fake()->name(),
            'image' =>fake()->name(),
            'trailerUrl' =>fake()->name(),
            'trailer' =>fake()->name(),
            'trailer2' =>fake()->name(),
            'trailer3' =>fake()->name(),
            '1episode' =>fake()->name(),
            '2episode' =>fake()->name(),
            '3episode' =>fake()->name(),
            '4episode' =>fake()->name(),
            '5episode' =>fake()->name(),
            'slider' =>fake()->name(),
            'year' =>fake()->name(),
            'country' =>fake()->name(),
            'genre' =>fake()->name(),
            'quality' =>fake()->name(),
            'director' =>fake()->name(),
            'cast' =>fake()->name(),
            'episodes' =>fake()->name(),
            'subtitles' =>fake()->name(),
            'subtitles_lang' =>fake()->name(),
            'mande' =>fake()->name(),
            'mande_lang' =>fake()->name(),
        ];
    }
}
