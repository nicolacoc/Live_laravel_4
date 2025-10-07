<?php

namespace Database\Factories;

use App\Models\Film;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\film>
 */
class filmFactory extends Factory
{
    protected $model = Film::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->title;
        return [
            'title' => $title,
            'description' => '',
            'release_year' => $this->faker->year(),
            'slug' => str::slug($title),
            'language_id' => 1,
            'original_language_id' => 1,
        ];


    }

}
